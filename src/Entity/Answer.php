<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "answers")]
class Answer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Result::class, inversedBy: 'answers')]
    #[ORM\JoinColumn(nullable: false)]
    private Result $result;

    #[ORM\ManyToOne(targetEntity: Question::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Question $question;

    #[ORM\ManyToMany(targetEntity: Option::class)]
    #[ORM\JoinTable(name: 'answers_options')]
    private Collection $selectedOptions;

    public function __construct()
    {
        $this->selectedOptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResult(): ?Result
    {
        return $this->result;
    }

    public function setResult(?Result $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getSelectedOptions(): Collection
    {
        return $this->selectedOptions;
    }

    public function setSelectedOptions(array $selectedOptions): self
    {
        $this->selectedOptions = new ArrayCollection($selectedOptions);

        return $this;
    }
}
