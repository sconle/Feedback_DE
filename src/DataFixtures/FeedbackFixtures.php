<?php

namespace App\DataFixtures;

use App\Entity\Course;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Feedback;
use App\Entity\User;

class FeedbackFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 0;$i<75;$i++){
            for($j=0;$j<=rand(0,10);$j++){      //Pour tous les utilisateurs on crée entre 0 et 10 feedbacks

                $User = $manager->getRepository(User::class)->findall();
                $Course = $manager->getRepository(Course::class)->findall();
                $feedback = new Feedback();
                $feedback ->setTitle("titre".$i.$j)
                    ->setComment(uniqid().uniqid().uniqid().uniqid().uniqid())
                    ->setOverall(rand(0,5))
                    ->setDifficulty(rand(0,5))
                    ->setInterest(rand(0,5))
                    ->setValid(rand(1,100) < 75)
                    ->setAuthor($User[array_rand($User)])
                    ->setCourse($Course[array_rand($Course)]);

                $manager->persist($feedback);
            }


        }


        $manager->flush();
    }
}
