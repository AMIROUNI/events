<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $pernom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    /**
     * @var Collection<int, Inscription>
     */
    #[ORM\OneToMany(targetEntity: Inscription::class, mappedBy: 'Client', orphanRemoval: true)]
    private Collection $Incriptions;

    public function __construct()
    {
        $this->Incriptions = new ArrayCollection();
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

    public function getPernom(): ?string
    {
        return $this->pernom;
    }

    public function setPernom(string $pernom): static
    {
        $this->pernom = $pernom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getIncriptions(): Collection
    {
        return $this->Incriptions;
    }

    public function addIncription(Inscription $incription): static
    {
        if (!$this->Incriptions->contains($incription)) {
            $this->Incriptions->add($incription);
            $incription->setClient($this);
        }

        return $this;
    }

    public function removeIncription(Inscription $incription): static
    {
        if ($this->Incriptions->removeElement($incription)) {
            // set the owning side to null (unless already changed)
            if ($incription->getClient() === $this) {
                $incription->setClient(null);
            }
        }

        return $this;
    }
}
