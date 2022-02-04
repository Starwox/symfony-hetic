<?php

namespace App\DataFixtures;

use App\Entity\Announce;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 10 users! Bam!
        for ($i = 0; $i < 10; $i++) {
            $email =  substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'),1, 8);
            $username =  substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'),1, 8);
            $password =  substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'),1, 8);

            $user = new User();
            $user->setEmail($email . '@gmail.com');
            $roles[] = 'ROLE_USER';
            $user->setRoles($roles);
            $user->setUsername($username);
            $user->setPassword($password);
            $manager->persist($user);
        }

        $user->setEmail('root@gmail.com');
        $user->setPassword("$2y$13\$OJMcta.M8M.hCQelBn7CX.1nDl8cc.FMdJLfYn6oPGDgFXlyDe6ie");
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user->setUsername('root');
        $manager->persist($user);

        // create 4 category! Bam!
        $namesCat = ['Voiture','Electronique', 'Voyage', 'Emploi'];

        foreach ($namesCat as $nameCat) {
            $category = new Category();
            $category->setName($nameCat);
            $manager->persist($category);
        }
        $manager->flush();
    }
}
