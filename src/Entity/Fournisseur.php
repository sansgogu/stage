<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FournisseurRepository::class)]
class Fournisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomclient = null;

    #[ORM\Column(length: 255)]
    private ?string $matriculefiscale = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column]
    private ?int $tlfn = null;

    /**
     * @var Collection<int, Produit>
     */
    #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'fournisseur')]
    private Collection $produit;

    public function __construct()
    {
        $this->produit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomclient(): ?string
    {
        return $this->nomclient;
    }

    public function setNomclient(string $nomclient): static
    {
        $this->nomclient = $nomclient;

        return $this;
    }

    public function getMatriculefiscale(): ?string
    {
        return $this->matriculefiscale;
    }

    public function setMatriculefiscale(string $matriculefiscale): static
    {
        $this->matriculefiscale = $matriculefiscale;

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

    public function getTlfn(): ?int
    {
        return $this->tlfn;
    }

    public function setTlfn(int $tlfn): static
    {
        $this->tlfn = $tlfn;

        return $this;
    }

    /**
     * @return Collection<int, produit>
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->produit->contains($produit)) {
            $this->produit->add($produit);
            $produit->setFournisseur($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        if ($this->produit->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getFournisseur() === $this) {
                $produit->setFournisseur(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return  $this->nomclient . ' - ' . $this->matriculefiscale . ' - ' . $this->adresse . ' - ' . $this->tlfn;
    }
}
