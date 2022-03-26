<?php

namespace App\Entity;

use App\Repository\RecruteurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecruteurRepository::class)
 */
class Recruteur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $entreprise_nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $entreprise_adresse;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $entreprise_code_postal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $entreprise_ville;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $consultant;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntrepriseNom(): ?string
    {
        return $this->entreprise_nom;
    }

    public function setEntrepriseNom(?string $entreprise_nom): self
    {
        $this->entreprise_nom = $entreprise_nom;

        return $this;
    }

    public function getEntrepriseAdresse(): ?string
    {
        return $this->entreprise_adresse;
    }

    public function setEntrepriseAdresse(?string $entreprise_adresse): self
    {
        $this->entreprise_adresse = $entreprise_adresse;

        return $this;
    }

    public function getEntrepriseCodePostal(): ?string
    {
        return $this->entreprise_code_postal;
    }

    public function setEntrepriseCodePostal(?string $entreprise_code_postal): self
    {
        $this->entreprise_code_postal = $entreprise_code_postal;

        return $this;
    }

    public function getEntrepriseVille(): ?string
    {
        return $this->entreprise_ville;
    }

    public function setEntrepriseVille(?string $entreprise_ville): self
    {
        $this->entreprise_ville = $entreprise_ville;

        return $this;
    }

    public function getConsultant(): ?User
    {
        return $this->consultant;
    }

    public function setConsultant(?User $consultant): self
    {
        $this->consultant = $consultant;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


}
