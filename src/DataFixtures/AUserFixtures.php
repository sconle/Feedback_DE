<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;

class AUserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 0;$i<75;$i++){

            $user = new User();
            $names = array(
                'Christopher',
                'Ryan',
                'Ethan',
                'John',
                'Zoey',
                'Sarah',
                'Michelle',
                'Samantha',
                'Jean-Claude'
            );
            $lastnames = array(
                'Walker',
                'Thompson',
                'Anderson',
                'Johnson',
                'Tremblay',
                'Peltier',
                'Cunningham',
                'Simpson',
                'Mercado',
                'Sellers'
            );

            $promo = array(
                'A', 'B'
            );

            $roles = array(
                'admin', 'moderateur', 'prof', 'eleve'
            );

            $user->setLastName($lastnames[mt_rand(0, sizeof($lastnames) - 1)])
                ->setFirstName($names[mt_rand(0, sizeof($names) - 1)])
                ->setEmail($user -> getLastName().'.'.$user -> getFirstName().$i.'@centrale-marseille.fr')
                ->setPassword(uniqid())
                ->setPromo($promo[array_rand($promo, 1)])
                ->setUsername($user->getLastName().$i);
            $roluser = array($roles[rand(2,3)]);
            if(rand(1,100)>=85){
                array_push($roluser,$roles[rand(0,1)]);
            }
            $user->setRoles($roluser);

            $manager->persist($user);
        }

        $manager->flush();

    }
}
