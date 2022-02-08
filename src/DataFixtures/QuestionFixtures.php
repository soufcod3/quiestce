<?php

namespace App\DataFixtures;

use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\BWilderFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class QuestionFixtures extends Fixture
{
    public const QUESTIONS = [
        'Qui a de la classe ?' => 'Mouais ça je sais pas',
        'Qui a les dent blanches ?' => 'Elles sont blanches la nuit seulement',
        'Qui a des lunettes ?' => 'Non j\'ai pas de lunettes mec',
        'Qui est drôle ?' => 'Heuuu',
        'Qui est chaud en code ?' => 'Tout est relatif',
        'Qui sait parler anglais ?' => 'Ouais jsuis à laise',
        'Qui parle chinois ?' => 'Of course I can',
        'Qui a déjà gagné un hackaton' => 'Oui cest déjà fait ça',
        'Qui a quasiment terminé son projet client ?' => 'Ouaip',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::QUESTIONS as $questionTitle => $answer) {
            $question = new Question();
            $question->setTitle($questionTitle);
            $question->setAnswer($answer);
            $question->setWilder($this->getReference('wilder_1'));

            $manager->persist($question);
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
