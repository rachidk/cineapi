<?php

namespace App\Entity;

use App\Entity\Movie as Movie;
use App\Entity\Type as Type;
use App\Repository\MovieTypeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MovieTypeRepository::class)]
class MovieType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity:Movie::class)]
    #[ORM\JoinColumn(nullable:false)]
    private ?Movie $movie = null;

    #[Groups(['read:collection:movie'])]
    #[ORM\ManyToOne(targetEntity:Type::class)]
    #[ORM\JoinColumn(nullable:false)]
    private ?Type $type = null;

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

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
