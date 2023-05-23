<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionRepository::class)]
class Session
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'session', targetEntity: Message::class)]
    private Collection $messages;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $gameMaster = null;

    #[ORM\OneToMany(mappedBy: 'session', targetEntity: Action::class, orphanRemoval: true)]
    private Collection $actions;

    #[ORM\ManyToMany(targetEntity: LienCompetenceCaracteristique::class, mappedBy: 'session')]
    private Collection $lienCompetenceCaracteristiques;

    #[ORM\OneToMany(mappedBy: 'session', targetEntity: CompetenceCharacter::class)]
    private Collection $competenceCharacters;

    #[ORM\OneToMany(mappedBy: 'session', targetEntity: CaracteristiquePerso::class, orphanRemoval: true)]
    private Collection $caracteristiquePersos;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    private ?CollectionCompetence $collectionCompetence = null;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    private ?CollectionCaracteristique $collectionCaracteristique = null;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->actions = new ArrayCollection();
        $this->lienCompetenceCaracteristiques = new ArrayCollection();
        $this->competenceCharacters = new ArrayCollection();
        $this->caracteristiquePersos = new ArrayCollection();
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
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setSession($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getSession() === $this) {
                $message->setSession(null);
            }
        }

        return $this;
    }

    public function getGameMaster(): ?User
    {
        return $this->gameMaster;
    }

    public function setGameMaster(?User $gameMaster): self
    {
        $this->gameMaster = $gameMaster;

        return $this;
    }

    /**
     * @return Collection<int, Action>
     */
    public function getActions(): Collection
    {
        return $this->actions;
    }

    public function addAction(Action $action): self
    {
        if (!$this->actions->contains($action)) {
            $this->actions->add($action);
            $action->setSession($this);
        }

        return $this;
    }

    public function removeAction(Action $action): self
    {
        if ($this->actions->removeElement($action)) {
            // set the owning side to null (unless already changed)
            if ($action->getSession() === $this) {
                $action->setSession(null);
            }
        }

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
            $lienCompetenceCaracteristique->addSession($this);
        }

        return $this;
    }

    public function removeLienCompetenceCaracteristique(LienCompetenceCaracteristique $lienCompetenceCaracteristique): self
    {
        if ($this->lienCompetenceCaracteristiques->removeElement($lienCompetenceCaracteristique)) {
            $lienCompetenceCaracteristique->removeSession($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, CompetenceCharacter>
     */
    public function getCompetenceCharacters(): Collection
    {
        return $this->competenceCharacters;
    }

    public function addCompetenceCharacter(CompetenceCharacter $competenceCharacter): self
    {
        if (!$this->competenceCharacters->contains($competenceCharacter)) {
            $this->competenceCharacters->add($competenceCharacter);
            $competenceCharacter->setSession($this);
        }

        return $this;
    }

    public function removeCompetenceCharacter(CompetenceCharacter $competenceCharacter): self
    {
        if ($this->competenceCharacters->removeElement($competenceCharacter)) {
            // set the owning side to null (unless already changed)
            if ($competenceCharacter->getSession() === $this) {
                $competenceCharacter->setSession(null);
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
            $caracteristiquePerso->setSession($this);
        }

        return $this;
    }

    public function removeCaracteristiquePerso(CaracteristiquePerso $caracteristiquePerso): self
    {
        if ($this->caracteristiquePersos->removeElement($caracteristiquePerso)) {
            // set the owning side to null (unless already changed)
            if ($caracteristiquePerso->getSession() === $this) {
                $caracteristiquePerso->setSession(null);
            }
        }

        return $this;
    }

    public function getCollectionCompetence(): ?CollectionCompetence
    {
        return $this->collectionCompetence;
    }

    public function setCollectionCompetence(?CollectionCompetence $collectionCompetence): self
    {
        $this->collectionCompetence = $collectionCompetence;

        return $this;
    }

    public function getCollectionCaracteristique(): ?CollectionCaracteristique
    {
        return $this->collectionCaracteristique;
    }

    public function setCollectionCaracteristique(?CollectionCaracteristique $collectionCaracteristique): self
    {
        $this->collectionCaracteristique = $collectionCaracteristique;

        return $this;
    }
}
