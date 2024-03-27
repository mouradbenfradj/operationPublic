<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AvisRepository::class)
 */
class Avis
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Suivit::class, inversedBy="avis")
     */
    private $operation;

    /**
     * @ORM\Column(type="integer")
     */
    private $note;

    /**
     * @ORM\Column(type="text")
     */
    private $defaux;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $danger;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="avis")
     */
    private $Utilisateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOperation(): ?Suivit
    {
        return $this->operation;
    }

    public function setOperation(?Suivit $operation): self
    {
        $this->operation = $operation;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getDefaux(): ?string
    {
        return $this->defaux;
    }

    public function setDefaux(string $defaux): self
    {
        $this->defaux = $defaux;

        return $this;
    }

    public function getDanger(): ?string
    {
        return $this->danger;
    }

    public function setDanger(?string $danger): self
    {
        $this->danger = $danger;

        return $this;
    }

    public function getUtilisateur(): ?User
    {
        return $this->Utilisateur;
    }

    public function setUtilisateur(?User $Utilisateur): self
    {
        $this->Utilisateur = $Utilisateur;

        return $this;
    }
}
