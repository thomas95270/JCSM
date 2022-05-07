<?php

namespace App\Entity;

use App\Repository\LicencieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LicencieRepository::class)]
class Licencie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 14, nullable: true)]
    private $numlicence;

    #[ORM\Column(type: 'string', length: 255)]
    private $cotisation;

    #[ORM\Column(type: 'string', length: 3, nullable: true)]
    private $grade;

    #[ORM\Column(type: 'float', nullable: true)]
    private $poids;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'licencies')]
    #[ORM\JoinColumn(nullable: false)]
    private $categorie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumlicence(): ?string
    {
        return $this->numlicence;
    }

    public function setNumlicence(?string $numlicence): self
    {
        $this->numlicence = $numlicence;

        return $this;
    }

    public function getCotisation(): ?string
    {
        return $this->cotisation;
    }

    public function setCotisation(string $cotisation): self
    {
        $this->cotisation = $cotisation;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(?string $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getPoids(): ?float
    {
        return $this->poids;
    }

    public function setPoids(?float $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
}
