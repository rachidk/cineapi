<?php

namespace App\Entity;

use App\Repository\MoviePeopleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MoviePeopleRepository::class)]
class MoviePeople
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity:Movie::class)]
    #[ORM\JoinColumn(nullable:false)]
    private ?Movie $movie = null;

    #[ORM\ManyToOne(targetEntity:People::class)]
    #[ORM\JoinColumn(nullable:false)]
    private ?People $people = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\Column(length: 255)]
    private ?string $significance = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    public function setMovie(Movie $movie): self
    {
        $this->movie = $movie;

        return $this;
    }

    public function getPeople(): ?People
    {
        return $this->people;
    }

    public function setPeople(People $people): self
    {
        $this->people = $people;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getSignifiance(): ?string
    {
        return $this->significance;
    }

    public function setSignifiance(string $significance): self
    {
        $this->significance = $significance;

        return $this;
    }
}
