<?php

namespace App\Entity;

use App\Repository\SeuilMaximumRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeuilMaximumRepository::class)]
class SeuilMaximum
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $seuilMaximum = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeuilMaximum(): ?int
    {
        return $this->seuilMaximum;
    }

    public function setSeuilMaximum(int $seuilMaximum): self
    {
        $this->seuilMaximum = $seuilMaximum;

        return $this;
    }
}
