<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder){
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager): void
    {
        $users = [
            ["VANDEN MAAGDENBERG", "Thomas", "admin@gmail.com", "mdp", ["ROLE_ADMIN"]],
            ["KANO", "Gigoro", "gk@gmail.com", "mdp", ["ROLE_USER"]],
        ];
    
        foreach( $users as $u){
            $user = new User();
            $date= new \DateTime();
            $password = $this->encoder->hashPassword($user, $u[3]);
            $user 
                -> setNom($u[0])
                -> setPrenom($u[1])
                -> setEmail($u[2])
                -> setPassword($password)
                -> setRoles($u[4])
                -> setDateCreation($date);
    
    
                $manager->persist($user);
            }
        $manager->flush();
    }
}
