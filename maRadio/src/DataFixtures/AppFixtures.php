<?php

namespace App\DataFixtures;

use App\Entity\UserAdmin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new UserAdmin();
        $user->setIdAdmin('adminRadio');

        $password = $this->encoder->encodePassword($user, 'administrateurRadio');
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();
    }
}
