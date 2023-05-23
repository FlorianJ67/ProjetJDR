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

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->actions = new ArrayCollection();
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
}
