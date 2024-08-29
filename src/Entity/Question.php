<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "questions")]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $text;

    #[ORM\OneToMany(targetEntity: Option::class, mappedBy: "question")]
    private Collection $options;

    #[ORM\OneToMany(targetEntity: Answer::class, mappedBy: 'question', cascade: ['persist', 'remove'])]
    private Collection $answers;

    #[ORM\ManyToMany(targetEntity: Result::class, inversedBy: 'questions')]
    #[ORM\JoinTable(name: 'questions_results')]
    private Collection $results;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->options = new ArrayCollection();
        $this->results = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function getResults(): Collection
    {
        return $this->results;
    }

    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addResult(Result $result): self
    {
        if (!$this->results->contains($result)) {
            $this->results[] = $result;
        }

        return $this;
    }
}
