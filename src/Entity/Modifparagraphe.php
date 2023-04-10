<?php

namespace App\Entity;

use App\Repository\ModifparagrapheRepository;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;

#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: ModifparagrapheRepository::class)]
class Modifparagraphe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'modifparagraphe')]
    #[ORM\Column(type: 'string',length:2000)]
    private ?string $paragraphe = null;

    #[ORM\Column(type: 'datetime')]
    private \DateTime  $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParagraphe(): ?string
    {
        return $this->paragraphe;
    }

    public function setParagraphe(?string $paragraphe): void
    {
        $this->paragraphe = $paragraphe;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

}
