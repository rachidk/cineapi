<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PeopleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource()]
#[ORM\Entity(repositoryClass: PeopleRepository::class)]
class People
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['read:collection:movie'])]
    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[Groups(['read:collection:movie'])]
    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[Groups(['read:collection:movie'])]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthdate = null;

    #[Groups(['read:collection:movie'])]
    #[ORM\Column(length: 255)]
    private ?string $nationality = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }
}
