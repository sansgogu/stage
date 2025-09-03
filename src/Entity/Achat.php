<?php

namespace App\Entity;

use App\Repository\AchatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AchatRepository::class)]
class Achat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Produit = null;

    #[ORM\Column(length: 255)]
    private ?string $Quantite = null;

    #[ORM\Column]
    private ?float $Prixunitaire = null;

    #[ORM\Column]
    private ?\DateTime $Datedevente = null;

    #[ORM\Column(length: 255)]
    private ?string $Fournisseur = null;

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

    public function getQuantite(): ?string
    {
        return $this->Quantite;
    }

    public function setQuantite(string $Quantite): static
    {
        $this->Quantite = $Quantite;

        return $this;
    }

    public function getPrixunitaire(): ?float
    {
        return $this->Prixunitaire;
    }

    public function setPrixunitaire(float $Prixunitaire): static
    {
        $this->Prixunitaire = $Prixunitaire;

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

    public function getFournisseur(): ?string
    {
        return $this->Fournisseur;
    }

    public function setFournisseur(string $Fournisseur): static
    {
        $this->Fournisseur = $Fournisseur;

        return $this;
    }
}
