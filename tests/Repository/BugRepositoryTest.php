<?php

namespace App\Tests\Repository;

use App\Entity\Bug;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Repository\BugRepository;

class BugRepositoryTest extends KernelTestCase
{
    private ?BugRepository $bugRepository = null;
    private ?Connection $connection = null;
    private ?EntityManagerInterface $entityManager = null;

    // Id fijo de la fila de fixture; alto para no colisionar con datos reales.
    private const FIXTURE_BUG_ID = 90001;
    private const FIXTURE_HANDLER_ID = 200;
    private const FIXTURE_REPORTER_ID = 100;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->bugRepository = $container->get(BugRepository::class);
        $this->connection = $container->get(Connection::class);
        $this->entityManager = $container->get(EntityManagerInterface::class);

        // handler_id y reporter_id tienen FK contra mantis_user_table, así que primero
        // creamos los usuarios referenciados. Usamos ids altos (100/200) que no existen
        // en la BD de test para ser dueños del dato y garantizar assertCount(1).
        $this->insertUser(self::FIXTURE_HANDLER_ID, 'test_handler');
        $this->insertUser(self::FIXTURE_REPORTER_ID, 'test_reporter');

        // Insertamos la fila de fixture con DBAL directo (no vía ORM) a propósito:
        // la entidad Bug mapea handler_id/reporter_id/project_id dos veces (escalar +
        // ManyToOne), por lo que un persist() escribiría esas FK a null y el test no
        // probaría nada. Con un INSERT crudo controlamos exactamente handler_id/reporter_id.
        // project_id y category_id se dejan a null (ningún test los usa y así evitamos
        // arrastrar fixtures de proyecto/categoría).
        $this->connection->insert('mantis_bug_table', [
            'id'              => self::FIXTURE_BUG_ID,
            'project_id'      => null,
            'reporter_id'     => self::FIXTURE_REPORTER_ID,
            'handler_id'      => self::FIXTURE_HANDLER_ID,
            'duplicated_id'   => 0,
            'priority'        => 30,
            'severity'        => 10,
            'reproducibility' => 10,
            'status'          => 50,
            'resolution'      => 10,
            'eta'             => 10,
            'bug_text_id'     => 10,
            'category_id'     => null,
            'summary'         => 'Test bug',
            'last_updated'    => time(),
            'date_submitted'  => time(),
        ]);
    }

    protected function tearDown(): void
    {
        // Limpieza explícita de la fila de fixture y de los usuarios creados (DBAL).
        // El bug primero, luego los usuarios, para respetar las FK.
        $this->connection->delete('mantis_bug_table', ['id' => self::FIXTURE_BUG_ID]);
        $this->connection->delete('mantis_user_table', ['id' => self::FIXTURE_HANDLER_ID]);
        $this->connection->delete('mantis_user_table', ['id' => self::FIXTURE_REPORTER_ID]);
        parent::tearDown();
    }

    /**
     * Crea un usuario mínimo válido para satisfacer las FK del bug de fixture.
     */
    private function insertUser(int $id, string $name): void
    {
        $this->connection->insert('mantis_user_table', [
            'id'           => $id,
            'username'     => $name . '_' . $id,
            'realname'     => $name,
            'email'        => $name . '_' . $id . '@test.local',
            'enabled'      => 1,
            'protected'    => 0,
            'access_level' => 25,
            'password'     => md5('test'),
        ]);
    }

    // --- getIncidenciasByHandlerId ---

    // El método tipa el parámetro como int, así que pasar null debe lanzar TypeError.
    public function testGetIncidenciasByHandlerIdWithNull(): void
    {
        $this->expectException(\TypeError::class);
        $this->bugRepository->getIncidenciasByHandlerId(null);
    }

    // Un handler sin incidencias asignadas debe devolver un array vacío (no null, no error).
    public function testGetIncidenciasByHandlerIdWithNonExistentId(): void
    {
        $result = $this->bugRepository->getIncidenciasByHandlerId(99999);
        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }

    // El handler 200 tiene exactamente el bug creado en setUp (id 90001):
    // se comprueba que devuelve 1 resultado, que es una entidad Bug
    // y que efectivamente está asignado a ese handler.
    public function testGetIncidenciasByHandlerIdWithExistingId(): void
    {
        $result = $this->bugRepository->getIncidenciasByHandlerId(self::FIXTURE_HANDLER_ID);
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertCount(1, $result);
        $this->assertInstanceOf(Bug::class, $result[0]);
        $this->assertSame(self::FIXTURE_BUG_ID, $result[0]->getId());
    }

    // --- getIncidenciasByReporterId ---

    public function testGetIncidenciasByReporterIdWithNull(): void
    {
        $this->expectException(\TypeError::class);
        $this->bugRepository->getIncidenciasByReporterId(null);
    }

    public function testGetIncidenciasByReporterIdWithNonExistentId(): void
    {
        $result = $this->bugRepository->getIncidenciasByReporterId(99999);
        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }

    public function testGetIncidenciasByReporterIdWithExistingId(): void
    {
        $result = $this->bugRepository->getIncidenciasByReporterId(100);
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertCount(1, $result);
    }
}
