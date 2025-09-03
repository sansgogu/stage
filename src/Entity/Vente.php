<?php

namespace App\Entity;

use App\Repository\VenteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VenteRepository::class)]
class Vente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Produit = null;

    #[ORM\Column(length: 255)]
    private ?float $Quantite = null;

    #[ORM\Column]
    private ?float $PrixUnitaire = null;

    #[ORM\Column]
    private ?\DateTime $Datedevente = null;

    #[ORM\Column(length: 255)]
    private ?string $Client = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduit(): ?string
    {
        return $this->Produit;
    }

    public function setProduit(string $Produit): static
    {
        $this->Produit = $Produit;

        return $this;
    }

    public function getQuantite(): ?float
    {
        return $this->Quantite;
    }

    public function setQuantite(float $Quantite): static
    {
        $this->Quantite = $Quantite;

        return $this;
    }

    public function getPrixUnitaire(): ?float
    {
        return $this->PrixUnitaire;
    }

    public function setPrixUnitaire(float $PrixUnitaire): static
    {
        $this->PrixUnitaire = $PrixUnitaire;

        return $this;
    }

    public function getDatedevente(): ?\DateTime
    {
        return $this->Datedevente;
    }

    public function setDatedevente(\DateTime $Datedevente): static
    {
        $this->Datedevente = $Datedevente;

        return $this;
    }

    public function getClient(): ?string
    {
        return $this->Client;
    }

    public function setClient(string $Client): static
    {
        $this->Client = $Client;

        return $this;
    }
}
