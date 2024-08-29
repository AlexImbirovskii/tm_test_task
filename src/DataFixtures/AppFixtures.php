<?php

namespace App\DataFixtures;

use App\Entity\Option;
use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

const TEST_CONTENT = [
    [
        [
            'answer' => '3',
            'isCorrect' => false,
        ],
        [
            'answer' => '2',
            'isCorrect' => true,
        ],
        [
            'answer' => '0',
            'isCorrect' => false,
        ],
    ],
    [
        [
            'answer' => '4',
            'isCorrect' => true,
        ],
        [
            'answer' => '3 + 1',
            'isCorrect' => true,
        ],
        [
            'answer' => '10',
            'isCorrect' => false,
        ],
    ],
    [
        [
            'answer' => '1 + 5',
            'isCorrect' => true,
        ],
        [
            'answer' => '1',
            'isCorrect' => false,
        ],
        [
            'answer' => '6',
            'isCorrect' => true,
        ],
        [
            'answer' => '2 + 4',
            'isCorrect' => true,
        ],
    ],
    [
        [
            'answer' => '8',
            'isCorrect' => true,
        ],
        [
            'answer' => '4',
            'isCorrect' => false,
        ],
        [
            'answer' => '0',
            'isCorrect' => false,
        ],
        [
            'answer' => '0 + 8',
            'isCorrect' => true,
        ],
    ],
    [
        [
            'answer' => '6',
            'isCorrect' => false,
        ],
        [
            'answer' => '18',
            'isCorrect' => false,
        ],
        [
            'answer' => '10',
            'isCorrect' => true,
        ],
        [
            'answer' => '9',
            'isCorrect' => false,
        ],
        [
            'answer' => '0',
            'isCorrect' => false,
        ],
    ],
    [
        [
            'answer' => '3',
            'isCorrect' => false,
        ],
        [
            'answer' => '9',
            'isCorrect' => false,
        ],
        [
            'answer' => '0',
            'isCorrect' => false,
        ],
        [
            'answer' => '12',
            'isCorrect' => true,
        ],
        [
            'answer' => '5 + 7',
            'isCorrect' => true,
        ],
    ],
    [
        [
            'answer' => '5',
            'isCorrect' => false,
        ],
        [
            'answer' => '14',
            'isCorrect' => true,
        ],
    ],
    [
        [
            'answer' => '16',
            'isCorrect' => true,
        ],
        [
            'answer' => '12',
            'isCorrect' => false,
        ],
        [
            'answer' => '9',
            'isCorrect' => false,
        ],
        [
            'answer' => '5',
            'isCorrect' => false,
        ],
    ],
    [
        [
            'answer' => '18',
            'isCorrect' => true,
        ],
        [
            'answer' => '9',
            'isCorrect' => false,
        ],
        [
            'answer' => '17 + 1',
            'isCorrect' => true,
        ],
        [
            'answer' => '2 + 16',
            'isCorrect' => true,
        ],
    ],
    [
        [
            'answer' => '0',
            'isCorrect' => false,
        ],
        [
            'answer' => '2',
            'isCorrect' => false,
        ],
        [
            'answer' => '8',
            'isCorrect' => false,
        ],
        [
            'answer' => '20',
            'isCorrect' => true,
        ],
    ],
];

class AppFixtures extends Fixture
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function load(ObjectManager $manager): void
    {
        $questionRepository = $this->entityManager->getRepository(Question::class);
        $questionCount = $questionRepository->count();

        if ($questionCount > 0) {
            return;
        }

        foreach (TEST_CONTENT as $questionKey => $answers) {

            $question = new Question();
            $n = $questionKey + 1;
            $question->setText("$n + $n =");

            foreach ($answers as $answer) {

                $answerEntity = new Option();
                $answerEntity->setText($answer['answer']);
                $answerEntity->setQuestion($question);
                $answerEntity->setIsCorrect($answer['isCorrect']);

                $manager->persist($answerEntity);

            }

            $manager->persist($question);

        }

        $manager->flush();
    }
}
