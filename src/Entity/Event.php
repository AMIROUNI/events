<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateD = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateF = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $Categorie = null;

    /**
     * @var Collection<int, Inscription>
     */
    #[ORM\OneToMany(targetEntity: Inscription::class, mappedBy: 'Event')]
    private Collection $Inscriptions;

    public function __construct()
    {
        $this->Inscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateD(): ?\DateTimeInterface
    {
        return $this->dateD;
    }

    public function setDateD(\DateTimeInterface $dateD): static
    {
        $this->dateD = $dateD;

        return $this;
    }

    public function getDateF(): ?\DateTimeInterface
    {
        return $this->dateF;
    }

    public function setDateF(\DateTimeInterface $dateF): static
    {
        $this->dateF = $dateF;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
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

    public function getCategorie(): ?Categorie
    {
        return $this->Categorie;
    }

    public function setCategorie(?Categorie $Categorie): static
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection
    {
        return $this->Inscriptions;
    }

    public function addInscription(Inscription $inscription): static
    {
        if (!$this->Inscriptions->contains($inscription)) {
            $this->Inscriptions->add($inscription);
            $inscription->setEvent($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): static
    {
        if ($this->Inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getEvent() === $this) {
                $inscription->setEvent(null);
            }
        }

        return $this;
    }
}
