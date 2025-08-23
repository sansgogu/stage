<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FactureRepository::class)]
class Facture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'factures')]
    private ?ClientPro $client = null;

    #[ORM\Column]
    private ?float $total = null;

    #[ORM\Column]
    private ?float $tva = null;

    #[ORM\Column]
    private ?float $remise = null;

    #[ORM\ManyToOne(inversedBy: 'facture')]
    private ?User $user = null;

    /**
     * @var Collection<int, Lignefacture>
     */
    #[ORM\OneToMany(targetEntity: Lignefacture::class, mappedBy: 'facture')]
    private Collection $lignefactures;

    public function __construct()
    {
        $this->lignefactures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getClient(): ?ClientPro
    {
        return $this->client;
    }

    public function setClient(?ClientPro $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getTva(): ?float
    {
        return $this->tva;
    }

    public function setTva(float $tva): static
    {
        $this->tva = $tva;

        return $this;
    }

    public function getRemise(): ?float
    {
        return $this->remise;
    }

    public function setRemise(float $remise): static
    {
        $this->remise = $remise;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Lignefacture>
     */
    public function getLignefactures(): Collection
    {
        return $this->lignefactures;
    }

    public function addLignefacture(Lignefacture $lignefacture): static
    {
        if (!$this->lignefactures->contains($lignefacture)) {
            $this->lignefactures->add($lignefacture);
            $lignefacture->setFacture($this);
        }

        return $this;
    }

    public function removeLignefacture(Lignefacture $lignefacture): static
    {
        if ($this->lignefactures->removeElement($lignefacture)) {
            // set the owning side to null (unless already changed)
            if ($lignefacture->getFacture() === $this) {
                $lignefacture->setFacture(null);
            }
        }

        return $this;
    }
}
