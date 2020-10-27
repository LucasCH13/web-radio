<?php

namespace App\Tests\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;



class SecurityControllerTest extends WebTestCase{
    /*
    public function LoginTest() {
        $this->client=static::createClient();
        $this->crawler=$this->client->request('GET', '/login');

            $em=$this->client->getContainer()->get('doctrine')->getManager();
        $users=$em->getRepository("UserAdminRepository:UserAdmin")->findAll();
        $this->assertGreaterThan(0, count($users));
    }
    */
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
        // on remplie le formulaire
        $form = $crawler->selectButton('_submit')->form(array(
            'username'  => 'adminRadio',
            'password'  => 'administrateurRadio'
        ));
        $client->submit($form);
        */
}   