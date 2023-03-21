<?php

namespace App\DataFixtures;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Faker;

class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder,

    ){}
    public function load(ObjectManager $manager): void
    {$admin = new User();
        $admin->setEmail('admin@admin.fr');
        $admin->setNom('Jendo');
        $admin->setPrenom('Jule');
        $admin->setNumTel('0652229812');
        $admin->setAdresse('Garge');
        $admin->setAllergie('Rien');

        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'admin123456')
        );
        $admin->setConfirmpassword(
            $this->passwordEncoder->hashPassword($admin, 'admin123456')
        );
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        $faker = Faker\Factory::create('fr_FR');

        for($usr = 1; $usr <= 5; $usr++){
            $user = new User();
            $user->setEmail($faker->email);
            $user->setNom($faker->lastName);
            $user->setPrenom($faker->firstName);
            $user->setNumTel($faker->mobileNumber());
            $user->setAdresse($faker->address());
            $user->setAllergie($faker->word());
            $user->setPassword(
                $this->passwordEncoder->hashPassword($user, 'secret')
            );
            $user->setConfirmpassword(
                $this->passwordEncoder->hashPassword($user, 'secret')
            );
            $manager->persist($user);
        }

        $manager->flush();
    }
}

