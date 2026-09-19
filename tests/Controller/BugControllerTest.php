<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class BugControllerTest extends WebTestCase
{
    public static function dataProviderUrls(){
        yield "Bug" => ['/bug','/'];
        yield "Bug > Create" => ['/bug/create','/'];
        yield "Bug > Edit" => ['/bug/edit/1','/'];
        yield "Bug > Show > id" => ['/bug/show/1','/'];
    }

    /**
     * @dataProvider dataProviderUrls
     * @return void
     */
    public function testAccessWithOutLogin($from,$to): void
    {
        $client = static::createClient();
        $client->request('GET', $from);
        self::assertResponseRedirects($to);
    }
}
