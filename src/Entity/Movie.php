<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MovieRepository;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Service\ClientApi;


#[ApiResource(
    normalizationContext: ['groups' => ['read:collection:movie']]
)]
#[Get()]
#[GetCollection()]
#[Post(security: "is_granted('ROLE_USER')")]
#[Put(security: "is_granted('ROLE_USER')")]
#[Patch(security: "is_granted('ROLE_USER')")]
#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[Groups(['read:collection:movie'])]
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[Groups(['read:collection:movie'])]
    #[ORM\Column]
    private ?int $duration = null;

    #[Groups(['read:collection:movie'])]
    #[ORM\OneToMany(targetEntity:MovieType::class, mappedBy:'movie')]
    private $movieTypes;

    #[Groups(['read:collection:movie'])]
    #[ORM\OneToMany(targetEntity:MoviePeople::class, mappedBy:'movie')]
    private $moviePeoples;


    #[ORM\Column]
    private ?string $poster = null; 

    private $clientApi;


    public function __construct(ClientApi $clientApi)
    {
        $this->movieTypes = new ArrayCollection();
        $this->moviePeoples = new ArrayCollection();
        $this->clientApi = $clientApi;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function addMovieType(MovieType $movieType): self
    {
        if (!$this->movieTypes->contains($movieType)) {
            $this->movieTypes[] = $movieType;
        }

        return $this;
    }

    public function addMoviePeople(MoviePeople $moviePeople): self
    {
        if (!$this->moviePeoples->contains($moviePeople)) {
            $this->moviePeoples[] = $moviePeople;
        }

        return $this;
    }

    public function removeMovieType($movieType): self
    {
        $this->movieTypes->removeElement($movieType);

        return $this;
    }

    public function removeMoviePeople($moviePeople): self
    {
        $this->moviePeoples->removeElement($moviePeople);

        return $this;
    }

    public function getMovieTypes()
    {
        return $this->movieTypes;
    }

    public function getMoviePeoples()
    {
        return $this->moviePeoples;
    }


    public function setPoster(string $poster)
    {
        $this->poster = $poster;
    }


    public function getPoster()
    {
        if(empty($this->poster))
        {
            $this->poster = $this->clientApi->getPosterFromMovie($this);
        }

        dd($this->poster);
        return $this->poster;
    }


}
