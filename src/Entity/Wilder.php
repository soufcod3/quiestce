<?php

namespace App\Entity;

use App\Repository\WilderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WilderRepository::class)
 */
class Wilder
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Clues::class, mappedBy="wilder")
     */
    private $clues;

    /**
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="wilder")
     */
    private $questions;

    public function __construct()
    {
        $this->clues = new ArrayCollection();
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Clues[]
     */
    public function getClues(): Collection
    {
        return $this->clues;
    }

    public function addClue(Clues $clue): self
    {
        if (!$this->clues->contains($clue)) {
            $this->clues[] = $clue;
            $clue->setWilder($this);
        }

        return $this;
    }

    public function removeClue(Clues $clue): self
    {
        if ($this->clues->removeElement($clue)) {
            // set the owning side to null (unless already changed)
            if ($clue->getWilder() === $this) {
                $clue->setWilder(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setWilder($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getWilder() === $this) {
                $question->setWilder(null);
            }
        }

        return $this;
    }
}
