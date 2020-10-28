<?php

namespace App\Tests\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\UserAdmin;
use App\Repository\UserAdminRepository;


class SecurityControllerTest extends WebTestCase {
    
    const LOGIN_ERROR='Lucas';
    const PASS_ERROR='octane';

    const LOGIN='adminRadio';
    const PASS='administrateurRAdio';
    const PASS_CRYPT='$argon2id$v=19$m=65536,t=4,p=1$OVllOHJVa1FSdEdRczVKcQ$dp903WRg+rphnYw6HXVAo5ygeDHe+MkFgvXqslwhbZo';

    const ID_SUBMIT='_submit';

    public function testSecurity() {
        $this->client=static::createClient();
        $this->crawler=$this->client->request('GET', '/login');

        //Savoir si il y a des utilisateurs dans la base

            $em=$this->client->getContainer()->get('doctrine')->getManager();
        $users=$em->getRepository("App\Entity\UserAdmin")->findAll();
        $this->assertGreaterThan(0, count($users));

        //Utilisateur valide ou non
        $valid_user=$em->getRepository("App\Entity\UserAdmin")->findBy(
            array('username' => self::LOGIN,
                'password' => self::PASS_CRYPT));
        $this->assertGreaterThan(0, count($valid_user));
    
        //Utilisateur non valide uniquement
        $invalid_user=$em->getRepository("App\Entity\UserAdmin")->findBy(
            array('username' => self::LOGIN_ERROR,
                'password' => self::PASS_ERROR));
        $this->assertEquals(0, count($invalid_user));

    }

    public function testUserRedirect() {
        //on crée un client
        $client = static::createClient(
                array(),
                array(
                    'HTTP_HOST' => '127.0.0.1',         
            ));
        //on demande l'acces à /login
        $crawler = $client->request('GET', '/login');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Problème survenu pour /login");
        
        if ($client->getResponse()->isRedirection()) {
            $client->followRedirect();
        }
        $this->assertTrue($client->getResponse()->isSuccessful());
        
    }
    /*
    public function testLoginForm() {
        
    }
      */  
}   