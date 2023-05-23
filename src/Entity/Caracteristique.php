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

    public function __construct()
    {
        $this->lienCompetenceCaracteristiques = new ArrayCollection();
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

}
