<?php

namespace App\Entity;

use App\Repository\HoraireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HoraireRepository::class)]
class Horaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\ManyToOne(inversedBy: 'horaires')]
    #[ORM\Column(length: 255)]
    private ?string $premierjour;


    #[ORM\Column(length: 255)]
    private ?string $dernierjour = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heureOuvertureMatin = null;
    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heureFerMatin = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heureOuvertureSoire = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heureFerSoire = null;

    #[ORM\Column(length: 255)]
    private ?string $jour = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPremierjour(): ?string
    {
        return $this->premierjour;
    }

    public function setPremierjour(string  $premierjour): self
    {
        $this->premierjour = $premierjour;

        return $this;
    }
    public function getDernierjour(): ?string
    {
        return $this->dernierjour;
    }

    public function setDernierjour(string $dernierjour): self
    {
        $this->dernierjour = $dernierjour;

        return $this;
    }

    public function getHeureOuvertureMatin(): ?\DateTimeInterface
    {
        return $this->heureOuvertureMatin;
    }

    public function setHeureOuvertureMatin(\DateTimeInterface $heureOuvertureMatin): self
    {
        $this->heureOuvertureMatin = $heureOuvertureMatin;

        return $this;
    }

    
    

    public function getHeureFerMatin(): ?\DateTimeInterface
    {
        return $this->heureFerMatin;
    }

    public function setHeureFerMatin(\DateTimeInterface $heureFerMatin): self
    {
        $this->heureFerMatin = $heureFerMatin;

        return $this;
    }

    public function getHeureOuvertureSoire(): ?\DateTimeInterface
    {
        return $this->heureOuvertureSoire;
    }

    public function setHeureOuvertureSoire(\DateTimeInterface $heureOuvertureSoire): self
    {
        $this->heureOuvertureSoire = $heureOuvertureSoire;

        return $this;
    }

    public function getHeureFerSoire(): ?\DateTimeInterface
    {
        return $this->heureFerSoire;
    }

    public function setHeureFerSoire(\DateTimeInterface $heureFerSoire): self
    {
        $this->heureFerSoire = $heureFerSoire;

        return $this;
    }

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(string $jour): self
    {
        $this->jour = $jour;

        return $this;
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
    // public function __toString()
    // {
    //     return $this->heureOuvertureMatin ;
    //     return $this->heureFerMatin ;
    //     return $this->heureOuvertureSoire ;
    //     return $this->heureFerSoire ;

    // }

}
