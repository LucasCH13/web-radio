<?php

namespace App\DataFixtures;

use App\Entity\UserAdmin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

        public function __construct(UserPasswordEncoderInterface $passwordEncoder)
            {
                 $this->passwordEncoder = $passwordEncoder;
            }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new UserAdmin();
        $user->setUsername('adminRadio');

        $password = $this->passwordEncoder->encodePassword($user, 'administrateurRadio');
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();
    }
}
