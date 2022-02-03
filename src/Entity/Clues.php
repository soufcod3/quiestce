<?php

namespace App\Entity;

use App\Repository\CluesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CluesRepository::class)
 */
class Clues
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
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Wilder::class, inversedBy="clues")
     */
    private $wilder;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getWilder(): ?Wilder
    {
        return $this->wilder;
    }

    public function setWilder(?Wilder $wilder): self
    {
        $this->wilder = $wilder;

        return $this;
    }
}
