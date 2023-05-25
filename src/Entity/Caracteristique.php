<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use App\Entity\LienCompetenceCaracteristique;
use App\Repository\CaracteristiqueRepository;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: CaracteristiqueRepository::class)]
class Caracteristique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'caracteristique', targetEntity: LienCompetenceCaracteristique::class, orphanRemoval: true)]
    private Collection $lienCompetenceCaracteristiques;

    #[ORM\OneToMany(mappedBy: 'caracteristique', targetEntity: CaracteristiquePerso::class, orphanRemoval: true)]
    private Collection $caracteristiquePersos;

    #[ORM\OneToMany(mappedBy: 'caracteristique', targetEntity: CaracteristiqueContenu::class, orphanRemoval: true)]
    private Collection $caracteristiqueContenus;

    public function __construct()
    {
        $this->lienCompetenceCaracteristiques = new ArrayCollection();
        $this->caracteristiquePersos = new ArrayCollection();
        $this->caracteristiqueContenus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, LienCompetenceCaracteristique>
     */
    public function getLienCompetenceCaracteristiques(): Collection
    {
        return $this->lienCompetenceCaracteristiques;
    }

    public function addLienCompetenceCaracteristique(LienCompetenceCaracteristique $lienCompetenceCaracteristique): self
    {
        if (!$this->lienCompetenceCaracteristiques->contains($lienCompetenceCaracteristique)) {
            $this->lienCompetenceCaracteristiques->add($lienCompetenceCaracteristique);
            $lienCompetenceCaracteristique->setCaracteristique($this);
        }

        return $this;
    }

    public function removeLienCompetenceCaracteristique(LienCompetenceCaracteristique $lienCompetenceCaracteristique): self
    {
        if ($this->lienCompetenceCaracteristiques->removeElement($lienCompetenceCaracteristique)) {
            // set the owning side to null (unless already changed)
            if ($lienCompetenceCaracteristique->getCaracteristique() === $this) {
                $lienCompetenceCaracteristique->setCaracteristique(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CaracteristiquePerso>
     */
    public function getCaracteristiquePersos(): Collection
    {
        return $this->caracteristiquePersos;
    }

    public function addCaracteristiquePerso(CaracteristiquePerso $caracteristiquePerso): self
    {
        if (!$this->caracteristiquePersos->contains($caracteristiquePerso)) {
            $this->caracteristiquePersos->add($caracteristiquePerso);
            $caracteristiquePerso->setCaracteristique($this);
        }

        return $this;
    }

    public function removeCaracteristiquePerso(CaracteristiquePerso $caracteristiquePerso): self
    {
        if ($this->caracteristiquePersos->removeElement($caracteristiquePerso)) {
            // set the owning side to null (unless already changed)
            if ($caracteristiquePerso->getCaracteristique() === $this) {
                $caracteristiquePerso->setCaracteristique(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CaracteristiqueContenu>
     */
    public function getCaracteristiqueContenus(): Collection
    {
        return $this->caracteristiqueContenus;
    }

    public function addCaracteristiqueContenu(CaracteristiqueContenu $caracteristiqueContenu): self
    {
        if (!$this->caracteristiqueContenus->contains($caracteristiqueContenu)) {
            $this->caracteristiqueContenus->add($caracteristiqueContenu);
            $caracteristiqueContenu->setCaracteristique($this);
        }

        return $this;
    }

    public function removeCaracteristiqueContenu(CaracteristiqueContenu $caracteristiqueContenu): self
    {
        if ($this->caracteristiqueContenus->removeElement($caracteristiqueContenu)) {
            // set the owning side to null (unless already changed)
            if ($caracteristiqueContenu->getCaracteristique() === $this) {
                $caracteristiqueContenu->setCaracteristique(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

}
