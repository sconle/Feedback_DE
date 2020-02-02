<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Course;

class CourseFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $course = new Course();
        $course->setName("cours n°0")
            ->setIsOptionGroup(rand(0, 1) == 0)
            ->setIsUE(rand(0, 1) == 0);
        $manager->persist($course);
        for ($i = 1; $i < 25; $i++) {
            $course = new Course();
            $course->setName("cours n°$i")
                ->setIsOptionGroup(rand(0, 1) == 0)
                ->setIsUE(rand(0, 1) == 0);
            $manager->persist($course);
        }

        $manager->flush();

        $allCourse = $manager->getRepository(Course::class)->findall();
        for ($i = 0; $i < sizeof($allCourse) - 1; $i++) {
            $Course = $allCourse[$i];
            if (rand(0, 100) < 25) {
                $Course->setParent($allCourse[rand($i + 1, sizeof($allCourse) - 1)]);
            }
            $manager->persist($Course);
        }

        $manager->flush();
    }
}
