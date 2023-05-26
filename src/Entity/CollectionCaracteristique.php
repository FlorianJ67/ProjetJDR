<?php

namespace App\Entity;

use App\Entity\Session;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\CaracteristiqueContenu;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\CollectionCaracteristiqueRepository;

#[ORM\Entity(repositoryClass: CollectionCaracteristiqueRepository::class)]
class CollectionCaracteristique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: CaracteristiqueContenu::class, mappedBy: 'collectionCaracteristiques')]
    private Collection $caracteristiqueContenus;

    #[ORM\OneToMany(mappedBy: 'collectionCaracteristique', targetEntity: Session::class)]
    private Collection $sessions;

    public function __construct()
    {
        $this->caracteristiqueContenus = new ArrayCollection();
        $this->sessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $caracteristiqueContenu->addCollectionCaracteristique($this);
        }

        return $this;
    }

    public function removeCaracteristiqueContenu(CaracteristiqueContenu $caracteristiqueContenu): self
    {
        if ($this->caracteristiqueContenus->removeElement($caracteristiqueContenu)) {
            $caracteristiqueContenu->removeCollectionCaracteristique($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Session>
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Session $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions->add($session);
            $session->setCollectionCaracteristique($this);
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        if ($this->sessions->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getCollectionCaracteristique() === $this) {
                $session->setCollectionCaracteristique(null);
            }
        }

        return $this;
    }
    public function __toString() 
    {
        return $this->caracteristiqueContenus;
    }
}
