<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Skills;

class SkillsFixtures extends Fixture
{
    public const NAMES = [
        'HTML',
        'CSS',
        'PHP',
        'Symfony',
        'MySQL',
        'JavaScript',
        'Figma',
        'GitHub',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach(self::NAMES as $skillsName) {
            $skills = new Skills();
            $skills->setName($skillsName);
            $manager->persist($skills);
            $this->addReference('skills_' . $skillsName, $skills);
        }

        $manager->flush();
    }
}

