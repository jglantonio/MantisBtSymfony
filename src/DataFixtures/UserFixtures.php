<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $users = [
            ['username' => 'admin',   'email' => 'admin@test.com' , 'password' => md5('admin'), 'access_level' => 90],
            ['username' => 'jlopez',  'email' => 'jlopez@test.com', 'password' => md5('12345'), 'access_level' => 70],
            ['username' => 'mgarcia', 'email' => 'mgarcia@test.com', 'password' => md5('12345'), 'access_level' => 55],
            ['username' => 'mamado', 'email' => 'mamado@test.com', 'password' => md5('12345'), 'access_level' => 40],
            ['username' => 'paolla', 'email' => 'paolla@test.com', 'password' => md5('12345'), 'access_level' => 25],
            ['username' => 'chisme', 'email' => 'chisme@test.com', 'password' => md5('12345'), 'access_level' => 25],
        ];

        foreach ($users as $user) {
            $manager->getConnection()->insert('mantis_user_table', [
                'username'      => $user['username'],
                'email'         => $user['email'],
                'password'      => $user['password'],
                'cookie_string' => md5(uniqid($user['username'], true)), // ← único por usuario
                'access_level'  => $user['access_level'],
                'enabled'       => 1,
                'protected'     => 0,
                'date_created'  => time(),
                'last_visit'    => time(),
            ]);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
