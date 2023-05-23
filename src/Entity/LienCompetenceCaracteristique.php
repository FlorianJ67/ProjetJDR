<?php

namespace App\Entity;

use App\Repository\LienCompetenceCaracteristiqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LienCompetenceCaracteristiqueRepository::class)]
class LienCompetenceCaracteristique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Competence::class, inversedBy: 'lienCompetenceCaracteristiques')]
    private Collection $competence;

    #[ORM\ManyToOne(inversedBy: 'lienCompetenceCaracteristiques')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Caracteristique $caracteristique = null;

    #[ORM\ManyToMany(targetEntity: Session::class, inversedBy: 'lienCompetenceCaracteristiques')]
    private Collection $session;

    public function __construct()
    {
        $this->competence = new ArrayCollection();
        $this->session = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Competence>
     */
    public function getCompetence(): Collection
    {
        return $this->competence;
    }

    public function addCompetence(Competence $competence): self
    {
        if (!$this->competence->contains($competence)) {
            $this->competence->add($competence);
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): self
    {
        $this->competence->removeElement($competence);

        return $this;
    }

    public function getCaracteristique(): ?Caracteristique
    {
        return $this->caracteristique;
    }

    public function setCaracteristique(?Caracteristique $caracteristique): self
    {
        $this->caracteristique = $caracteristique;

        return $this;
    }

    /**
     * @return Collection<int, Session>
     */
    public function getSession(): Collection
    {
        return $this->session;
    }

    public function addSession(Session $session): self
    {
        if (!$this->session->contains($session)) {
            $this->session->add($session);
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        $this->session->removeElement($session);

        return $this;
    }
}
