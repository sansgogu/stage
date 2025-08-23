<?php

namespace App\Entity;

use App\Repository\LignefactureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LignefactureRepository::class)]
class Lignefacture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $referencedeproduit = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_de_produit = null;

    #[ORM\Column]
    private ?float $qte = null;

    #[ORM\Column]
    private ?float $prixunitaire = null;

    #[ORM\Column]
    private ?float $prixtotale = null;

    #[ORM\ManyToOne(inversedBy: 'lignefactures')]
    private ?facture $facture = null;

    #[ORM\ManyToOne(inversedBy: 'lignefacture')]
    private ?Produit $produit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReferencedeproduit(): ?string
    {
        return $this->referencedeproduit;
    }

    public function setReferencedeproduit(string $referencedeproduit): static
    {
        $this->referencedeproduit = $referencedeproduit;

        return $this;
    }

    public function getNomDeProduit(): ?string
    {
        return $this->nom_de_produit;
    }

    public function setNomDeProduit(string $nom_de_produit): static
    {
        $this->nom_de_produit = $nom_de_produit;

        return $this;
    }

    public function getQte(): ?float
    {
        return $this->qte;
    }

    public function setQte(float $qte): static
    {
        $this->qte = $qte;

        return $this;
    }

    public function getPrixunitaire(): ?float
    {
        return $this->prixunitaire;
    }

    public function setPrixunitaire(float $prixunitaire): static
    {
        $this->prixunitaire = $prixunitaire;

        return $this;
    }

    public function getPrixtotale(): ?float
    {
        return $this->prixtotale;
    }

    public function setPrixtotale(float $prixtotale): static
    {
        $this->prixtotale = $prixtotale;

        return $this;
    }

    public function getFacture(): ?facture
    {
        return $this->facture;
    }

    public function setFacture(?facture $facture): static
    {
        $this->facture = $facture;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): static
    {
        $this->produit = $produit;

        return $this;
    }
}
