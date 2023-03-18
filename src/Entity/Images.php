<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

use Doctrine\ORM\Mapping as ORM;
#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: ImagesRepository::class)]
class Images
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // #[ORM\Column(length: 255)]
    // private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Plat $plat = null;

    #[ORM\JoinColumn(nullable: false)]
    private ?Menu $menu = null;

    #[Vich\UploadableField(mapping: 'galeries', fileNameProperty: 'imageName',size: 'imageSize')]
    private ?File $imageFile = null;

    #[ORM\Column (type: 'string')]
    private ?string $imageName = null;

    // #[ORM\Column(type: 'integer')]
    // private ?int $imageSize = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable  $updatedAt;

    #[ORM\Column(type:'datetime_immutable')]
    private \DateTimeImmutable $createdAt;


    public function getId(): ?int
    {
        return $this->id;
    }

    // public function getName(): ?string
    // {
    //     return $this->name;
    // }

    // public function setName(string $name): self
    // {
    //     $this->name = $name;

    //     return $this;
    // }

    public function getPlat(): ?Plat
    {
        return $this->plat;
    }

    public function setPlat(?Plat $plat): self
    {
        $this->plat = $plat;

        return $this;
    }
    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}