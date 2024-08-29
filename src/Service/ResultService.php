<?php

namespace App\Service;

use App\Entity\Result;

class ResultService
{
    public function getResultData(Result $result): array
    {
        $data = [];

        foreach ($result->getQuestions() as $question) {
            $answers = $question->getAnswers()->filter(function ($answer) use ($result) {
                return $answer->getResult()->getId() === $result->getId();
            });

            $options = $question->getOptions()->filter(function ($option) use ($result) {
                return $option->getIsCorrect() === false;
            });

            $selectedOptionIds = [];
            foreach ($answers as $answer) {
                foreach ($answer->getSelectedOptions() as $option) {
                    $selectedOptionIds[] = $option->getId();
                }
            }

            $correctOptionsId = [];
            foreach ($options as $option) {
                $correctOptionsId[] = $option->getId();
            }

            $data[] = [
                'question' => $question,
                'options' => $question->getOptions(),
                'selectedOptionIds' => $selectedOptionIds,
                'correctOptionsId' => $correctOptionsId,
                'isAnswerRight' => array_intersect($selectedOptionIds, $correctOptionsId) === []
            ];
        }

        return $data;
    }
}
