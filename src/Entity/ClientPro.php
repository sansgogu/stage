<?php

namespace App\Entity;

use App\Repository\ClientProRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientProRepository::class)]
class ClientPro
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

   

   
}
