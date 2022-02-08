<?php

namespace App\DataFixtures;

use App\Entity\Clues;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\BWilderFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CluesFixtures extends Fixture
{
    public const CLUES = [
        "J'ai un haut Reebok bleu turquoise",
        "Je suis un gros bg sa mère",
        "J'adore Shaun Murphy",
        "Vive le e-sport !!!",
        "Je suis dingue de ski",
        "*vapote et SOUFFLE*"
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::CLUES as $key => $clueContent) {
            $clue = new Clues();
            $clue->setDescription($clueContent);
            $clue->setWilder($this->getReference('wilder_1'));

            $manager->persist($clue);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            BWilderFixtures::class,
        ];
    }
    
}
