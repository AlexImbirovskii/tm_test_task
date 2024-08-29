<?php

namespace App\Service;

use App\Entity\Answer;
use App\Entity\Option;
use App\Entity\Result;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;

class TestService
{
    public function validateTestForm(array $questions, array &$result, FormInterface $form): void
    {
        foreach ($questions as $question) {
            $selectedOptions = $form->get('question_' . $question->getId())->get('selectedOptions')->getData();

            if (empty($selectedOptions)) {
                $form->get('question_' . $question->getId())->get('selectedOptions')->addError(
                    new FormError('Select at least one option.')
                );
                continue;
            }

            $result[] = [
                'question' => $question,
                'selectedOptions' => $selectedOptions,
            ];
        }
    }
    public function storeTestResults(array $result, EntityManagerInterface $entityManager): Result
    {
        $resultEntity = new Result();
        foreach ($result as $resultItem) {
            $options = $entityManager->getRepository(Option::class)->findBy([
                'id' => $resultItem['selectedOptions']
            ]);

            $answer = new Answer();
            $answer->setQuestion($resultItem['question']);
            $answer->setResult($resultEntity);

            $answer->setSelectedOptions($options);
            $entityManager->persist($answer);
        }

        $resultEntity->setQuestions(array_column($result, 'question'));
        $entityManager->persist($resultEntity);
        $entityManager->flush();

        return $resultEntity;
    }
}
