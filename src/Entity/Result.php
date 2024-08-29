<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "results")]
class Result
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToMany(targetEntity: Question::class, mappedBy: 'results')]
    private Collection $questions;

    #[ORM\OneToMany(targetEntity: Answer::class, mappedBy: 'result', cascade: ['persist', 'remove'])]
    private Collection $answers;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->answers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function setQuestions(array $questions): self
    {
        $this->questions = new ArrayCollection($questions);

        foreach ($questions as $question) {
            $question->addResult($this);
        }

        return $this;
    }
}
