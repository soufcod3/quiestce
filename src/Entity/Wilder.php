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
     * @ORM\Column(type="string", length=255)
     */
    private $promo;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $hair;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $reconversion;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $glasses;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $beard;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $long_hair;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $children;

    /**
     * @ORM\OneToMany(targetEntity=Clues::class, mappedBy="wilder")
     */
    private $clues;

    public function __construct()
    {
        $this->clues = new ArrayCollection();
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

    public function getPromo(): ?string
    {
        return $this->promo;
    }

    public function setPromo(string $promo): self
    {
        $this->promo = $promo;

        return $this;
    }

    public function getHair(): ?bool
    {
        return $this->hair;
    }

    public function setHair(?bool $hair): self
    {
        $this->hair = $hair;

        return $this;
    }

    public function getReconversion(): ?bool
    {
        return $this->reconversion;
    }

    public function setReconversion(?bool $reconversion): self
    {
        $this->reconversion = $reconversion;

        return $this;
    }

    public function getGlasses(): ?bool
    {
        return $this->glasses;
    }

    public function setGlasses(?bool $glasses): self
    {
        $this->glasses = $glasses;

        return $this;
    }

    public function getBeard(): ?bool
    {
        return $this->beard;
    }

    public function setBeard(?bool $beard): self
    {
        $this->beard = $beard;

        return $this;
    }

    public function getLongHair(): ?bool
    {
        return $this->long_hair;
    }

    public function setLongHair(?bool $long_hair): self
    {
        $this->long_hair = $long_hair;

        return $this;
    }

    public function getChildren(): ?bool
    {
        return $this->children;
    }

    public function setChildren(?bool $children): self
    {
        $this->children = $children;

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
}
