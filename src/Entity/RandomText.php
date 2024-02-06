<?php

namespace App\Entity;

use App\Repository\RandomTextRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RandomTextRepository::class)]
class RandomText
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $content = null;

    #[ORM\Column(length: 255)]
    private ?string $owner = null;

    #[ORM\Column(type: Types::INTEGER, length: 255)]
    private ?int $counter = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getOwner(): ?string
    {
        return $this->owner;
    }

    public function setOwner(string $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getCounter(): ?int
    {
        return $this->counter;
    }

    public function setCounter(?int $counter): RandomText
    {
        $this->counter = $counter;
        return $this;
    }
}
