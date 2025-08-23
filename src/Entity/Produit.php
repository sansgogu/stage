<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $soustitre = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\ManyToOne(inversedBy: 'produit')]
    private ?Categorie $categorie = null;

    /**
     * @var Collection<int, lignefacture>
     */
    #[ORM\OneToMany(targetEntity: Lignefacture::class, mappedBy: 'produit')]
    private Collection $lignefacture;

    #[ORM\ManyToOne(inversedBy: 'produit')]
    private ?Fournisseur $fournisseur = null;

    /**
     * @var Collection<int, Notification>
     */
    #[ORM\OneToMany(targetEntity: Notification::class, mappedBy: 'produit')]
    private Collection $notifications;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $createdat = null;

    public function __construct()
    {
        $this->lignefacture = new ArrayCollection();
        $this->notifications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSoustitre(): ?string
    {
        return $this->soustitre;
    }

    public function setSoustitre(string $soustitre): static
    {
        $this->soustitre = $soustitre;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, lignefacture>
     */
    public function getLignefacture(): Collection
    {
        return $this->lignefacture;
    }

    public function addLignefacture(Lignefacture $lignefacture): static
    {
        if (!$this->lignefacture->contains($lignefacture)) {
            $this->lignefacture->add($lignefacture);
            $lignefacture->setProduit($this);
        }

        return $this;
    }

    public function removeLignefacture(Lignefacture $lignefacture): static
    {
        if ($this->lignefacture->removeElement($lignefacture)) {
            // set the owning side to null (unless already changed)
            if ($lignefacture->getProduit() === $this) {
                $lignefacture->setProduit(null);
            }
        }

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): static
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    /**
     * @return Collection<int, Notification>
     */
    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notification $notification): static
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications->add($notification);
            $notification->setProduit($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): static
    {
        if ($this->notifications->removeElement($notification)) {
            // set the owning side to null (unless already changed)
            if ($notification->getProduit() === $this) {
                $notification->setProduit(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedat(): ?\DateTimeImmutable
    {
        return $this->createdat;
    }

    public function setCreatedat(\DateTimeImmutable $createdat): static
    {
        $this->createdat = $createdat;

        return $this;
    }
}
