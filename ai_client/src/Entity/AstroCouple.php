<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class AstroCouple
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $nom1 = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $date_naissance1 = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $lieu_naissance1 = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $nom2 = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $date_naissance2 = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $lieu_naissance2 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getNom1(): ?string
    {
        return $this->nom1;
    }

    public function setNom1(?string $nom1): self
    {
        $this->nom1 = $nom1;
        return $this;
    }

    public function getDateNaissance1(): ?\DateTimeInterface
    {
        return $this->date_naissance1;
    }

    public function setDateNaissance1(?\DateTimeInterface $date_naissance1): self
    {
        $this->date_naissance1 = $date_naissance1;
        return $this;
    }

    public function getLieuNaissance1(): ?string
    {
        return $this->lieu_naissance1;
    }

    public function setLieuNaissance1(?string $lieu_naissance1): self
    {
        $this->lieu_naissance1 = $lieu_naissance1;
        return $this;
    }

    public function getNom2(): ?string
    {
        return $this->nom2;
    }

    public function setNom2(?string $nom2): self
    {
        $this->nom2 = $nom2;
        return $this;
    }

    public function getDateNaissance2(): ?\DateTimeInterface
    {
        return $this->date_naissance2;
    }

    public function setDateNaissance2(?\DateTimeInterface $date_naissance2): self
    {
        $this->date_naissance2 = $date_naissance2;
        return $this;
    }

    public function getLieuNaissance2(): ?string
    {
        return $this->lieu_naissance2;
    }

    public function setLieuNaissance2(?string $lieu_naissance2): self
    {
        $this->lieu_naissance2 = $lieu_naissance2;
        return $this;
    }
}
