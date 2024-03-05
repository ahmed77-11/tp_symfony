<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 5, max: 50, minMessage: 'ton nom au min {{ limit }} caracters ', maxMessage: 'ton nom au max {{ limit }} caracters')]
    private ?string $nom = null;

    #[ORM\Column(type: 'decimal', precision: 20, scale: 2)]
    #[Assert\NotEqualTo(
        value: 0,
        message: "Le prix d’un article ne doit pas être égal à 0 "
    )]
    private ?float $prix = null;
    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getArticles(): ?Category
    {
        return $this->articles;
    }

    public function setArticles(?Category $articles): static
    {
        $this->articles = $articles;

        return $this;
    }
}
