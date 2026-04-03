<?php

namespace App\Entity;

use App\Repository\BugRepository;
use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\SecurityBundle\Security;

#[ORM\Entity(repositoryClass: BugRepository::class)]
#[ORM\Table(name : 'mantis_bug_table')]
class Bug
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: 'project_id' ,type: 'integer',nullable: true )]
    private ?int $projectId = null;

    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'bugs')]
    private Project $project;

    #[ORM\Column]
    private ?int $reporter_id = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'bugs')]
    private User $reporter;

    #[ORM\Column]
    private ?int $handler_id = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'bugs')]
    private User  $handler;

    #[ORM\Column]
    private ?int $duplicate_id = null;

    #[ORM\Column]
    private ?int $priority = null;

    #[ORM\Column(name: 'last_updated' ,type: 'integer',nullable: true )]
    private ?int $lastUpdated = null;

    #[ORM\Column(name: 'date_submitted' ,type: 'integer',nullable: true )]
    private ?int $dateSubmitted = null;

    #[ORM\Column]
    private ?int $severity = null;

    #[ORM\Column]
    private ?int $reproducibility = null;

    #[ORM\Column]
    private ?int $status = null;

    #[ORM\Column]
    private ?int $resolution = null;

    #[ORM\Column]
    private ?int $eta = null;

    #[ORM\Column]
    private ?int $bug_text_id = null;

    #[ORM\Column]
    private ?string $summary = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProject(): ?object
    {
        return $this->project;
    }

    public function getProjectId(): ?int
    {
        return $this->projectId;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setProjectId(int $project_id): static
    {
        $this->project_id = $project_id;

        return $this;
    }

    public function getReporterId(): ?int
    {
        return $this->reporter_id;
    }

    public function setReporterId(int $reporter_id): static
    {
        $this->reporter_id = $reporter_id;

        return $this;
    }

    public function getHandler(): ?object
    {
        return $this->handler;
    }
    public function getReporter(): ?object
    {
        return $this->handler;
    }

    public function setHandlerId(int $handler_id): static
    {
        $this->handler_id = $handler_id;

        return $this;
    }

    public function getLastUpdated(){
        return date('Y-m-d H:i:s', $this->lastUpdated);
    }
    public function getDateSubmitted() {
        return date('Y-m-d H:i:s', $this->dateSubmitted);
    }
    public function getPriority(){
        return "Alta";
    }
    public function getStatus(){
        return "Ok";
    }
}
