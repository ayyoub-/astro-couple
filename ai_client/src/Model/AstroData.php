<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class AstroData
{
    #[Assert\NotBlank(message: "Le nom est obligatoire.")]
    #[Assert\Length(min: 2, max: 50, minMessage: "Le nom doit contenir au moins {{ limit }} caractères.")]
    public ?string $nom = null;

    #[Assert\NotBlank(message: "La date de naissance est obligatoire.")]
    #[Assert\Type(type: "\DateTimeInterface", message: "La date doit être valide.")]
    public ?\DateTimeInterface $date_naissance = null;

    #[Assert\NotBlank(message: "Le lieu de naissance est obligatoire.")]
    #[Assert\Length(min: 2, max: 100, minMessage: "Le lieu doit contenir au moins {{ limit }} caractères.")]
    public ?string $lieu_naissance = null;
}
