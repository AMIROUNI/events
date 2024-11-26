<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $detel = null;

    #[ORM\Column(length: 255)]
    private ?string $etatl = null;

    #[ORM\ManyToOne(inversedBy: 'Inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Event $Event = null;

    #[ORM\ManyToOne(inversedBy: 'Incriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $Client = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDetel(): ?\DateTimeInterface
    {
        return $this->detel;
    }

    public function setDetel(\DateTimeInterface $detel): static
    {
        $this->detel = $detel;

        return $this;
    }

    public function getEtatl(): ?string
    {
        return $this->etatl;
    }

    public function setEtatl(string $etatl): static
    {
        $this->etatl = $etatl;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->Event;
    }

    public function setEvent(?Event $Event): static
    {
        $this->Event = $Event;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->Client;
    }

    public function setClient(?Client $Client): static
    {
        $this->Client = $Client;

        return $this;
    }
}
