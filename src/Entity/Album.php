<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlbumRepository::class)]
class Album
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Fruit = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Annee = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Artistes = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Label = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Genre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Format = null;

    #[ORM\Column(length: 400, nullable: true)]
    private ?string $Tracklist = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'User_Album')]
    private Collection $Album_User;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $Url = null;

    public function __construct()
    {
        $this->Album_User = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getFruit(): ?string
    {
        return $this->Fruit;
    }

    public function setFruit(string $Fruit): static
    {
        $this->Fruit = $Fruit;

        return $this;
    }

    public function getAnnee(): ?string
    {
        return $this->Annee;
    }

    public function setAnnee(?string $Annee): static
    {
        $this->Annee = $Annee;

        return $this;
    }

    public function getArtistes(): ?string
    {
        return $this->Artistes;
    }

    public function setArtistes(?string $Artistes): static
    {
        $this->Artistes = $Artistes;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->Label;
    }

    public function setLabel(?string $Label): static
    {
        $this->Label = $Label;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->Genre;
    }

    public function setGenre(?string $Genre): static
    {
        $this->Genre = $Genre;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->Format;
    }

    public function setFormat(?string $Format): static
    {
        $this->Format = $Format;

        return $this;
    }

    public function getTracklist(): ?string
    {
        return $this->Tracklist;
    }

    public function setTracklist(?string $Tracklist): static
    {
        $this->Tracklist = $Tracklist;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getAlbumUser(): Collection
    {
        return $this->Album_User;
    }

    public function addAlbumUser(User $albumUser): static
    {
        if (!$this->Album_User->contains($albumUser)) {
            $this->Album_User->add($albumUser);
            $albumUser->addUserAlbum($this);
        }

        return $this;
    }

    public function removeAlbumUser(User $albumUser): static
    {
        if ($this->Album_User->removeElement($albumUser)) {
            $albumUser->removeUserAlbum($this);
        }

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->Url;
    }

    public function setUrl(?string $Url): static
    {
        $this->Url = $Url;

        return $this;
    }

}
