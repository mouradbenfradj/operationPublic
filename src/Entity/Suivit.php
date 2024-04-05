<?php

namespace App\Entity;

use App\Repository\SuivitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SuivitRepository::class)
 */
class Suivit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    public function __toString()
    {
        return $this->sujet;
    }
    /**
     * @ORM\Column(type="integer")
     */
    private $nature;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sujet;

    /**
     * @ORM\Column(type="float")
     */
    private $cout;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $proprietaire;

    /**
     * @ORM\Column(type="date")
     */
    private $debut;

    /**
     * @ORM\Column(type="date")
     */
    private $fin;

    /**
     * @ORM\Column(type="integer")
     */
    private $jourDeRetard;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $causeRetard;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $dateCauseResiliation;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateValidationFinal;

    /**
     * @ORM\OneToMany(targetEntity=Avis::class, mappedBy="operation")
     */
    private $avis;

    public function __construct()
    {
        $this->avis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNature(): ?int
    {
        return $this->nature;
    }

    public function setNature(int $nature): self
    {
        $this->nature = $nature;

        return $this;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): self
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function getCout(): ?float
    {
        return $this->cout;
    }

    public function setCout(float $cout): self
    {
        $this->cout = $cout;

        return $this;
    }

    public function getProprietaire(): ?string
    {
        return $this->proprietaire;
    }

    public function setProprietaire(string $proprietaire): self
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->debut;
    }

    public function setDebut(\DateTimeInterface $debut): self
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->fin;
    }

    public function setFin(\DateTimeInterface $fin): self
    {
        $this->fin = $fin;

        return $this;
    }

    public function getJourDeRetard(): ?int
    {
        return $this->jourDeRetard;
    }

    public function setJourDeRetard(int $jourDeRetard): self
    {
        $this->jourDeRetard = $jourDeRetard;

        return $this;
    }

    public function getCauseRetard(): ?string
    {
        return $this->causeRetard;
    }

    public function setCauseRetard(?string $causeRetard): self
    {
        $this->causeRetard = $causeRetard;

        return $this;
    }

    public function getDateCauseResiliation(): ?string
    {
        return $this->dateCauseResiliation;
    }

    public function setDateCauseResiliation(?string $dateCauseResiliation): self
    {
        $this->dateCauseResiliation = $dateCauseResiliation;

        return $this;
    }

    public function getDateValidationFinal(): ?\DateTimeInterface
    {
        return $this->dateValidationFinal;
    }

    public function setDateValidationFinal(?\DateTimeInterface $dateValidationFinal): self
    {
        $this->dateValidationFinal = $dateValidationFinal;

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): self
    {
        if (!$this->avis->contains($avi)) {
            $this->avis[] = $avi;
            $avi->setOperation($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): self
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getOperation() === $this) {
                $avi->setOperation(null);
            }
        }

        return $this;
    }
}
