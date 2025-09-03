<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Produit;

#[ORM\Entity]
class Fournisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $nom = null;

    

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $matriculefiscale = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private ?string $tlfn = null;

    #[ORM\OneToMany(mappedBy: 'fournisseur', targetEntity: Produit::class, orphanRemoval: true, cascade: ['remove'])]
    private Collection $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    // ----- Getters / Setters -----

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

   

    public function getMatriculefiscale(): ?string
    {
        return $this->matriculefiscale;
    }

    public function setMatriculefiscale(?string $matriculefiscale): self
    {
        $this->matriculefiscale = $matriculefiscale;
        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;
        return $this;
    }

    public function getTlfn(): ?string
    {
        return $this->tlfn;
    }

    public function setTlfn(?string $tlfn): self
    {
        $this->tlfn = $tlfn;
        return $this;
    }

    /** @return Collection<int, Produit> */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setFournisseur($this);
        }
        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            if ($produit->getFournisseur() === $this) {
                $produit->setFournisseur(null);
            }
        }
        return $this;
    }

    // ----- Méthode pratique pour Twig -----
    public function __toString(): string
    {
        return $this->nom ?? '';
    }
}
