<?php

namespace App\DataFixtures;

use App\Entity\Card;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        // user
        $user = new User();
        $user->setEmail("user@api.fr");
        $user->setRoles(["ROLE_USER"]);
        $user->setPassword($this->userPasswordHasher->hashPassword($user, "password"));
        $manager->persist($user);

        //admin
        $admin = new User();
        $admin->setEmail("admin@api.fr");
        $admin->setRoles(["ROLE_ADMIN"]);
        $admin->setPassword($this->userPasswordHasher->hashPassword($admin, "password"));
        $manager->persist($admin);

        for ($i = 0; $i < 10; $i++) {
            $card = new Card;
            $card->setName("card $i");
            $card->setValue($i);
            $card->setSpecials(0);
            $card->setImage("");
            
            $manager->persist($card);
        }

        $manager->flush();
    }
}
