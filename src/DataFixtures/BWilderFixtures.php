<?php

namespace App\DataFixtures;

use App\Entity\Wilder;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BWilderFixtures extends Fixture
{
    const NAMES = [
        'Soufiane',
        'Davy',
        'Alexandre',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::NAMES as $key => $name) {
            $wilder = new Wilder();
            $wilder->setName($name);

            $manager->persist($wilder);
            $this->addReference('wilder_' . $key, $wilder);   
        }
        
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CluesFixtures::class,
            QuestionFixtures::class,
        ];
    }
}
