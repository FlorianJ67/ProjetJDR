<?php

namespace App\Entity;

use App\Repository\CharacterStatsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharacterStatsRepository::class)]
class CharacterStats
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'characterStats', targetEntity: Session::class)]
    private Collection $session;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'characterStats')]
    private Collection $sessionUser;

    public function __construct()
    {
        $this->session = new ArrayCollection();
        $this->sessionUser = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $session->setCharacterStats($this);
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        if ($this->session->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getCharacterStats() === $this) {
                $session->setCharacterStats(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getSessionUser(): Collection
    {
        return $this->sessionUser;
    }

    public function addSessionUser(User $sessionUser): self
    {
        if (!$this->sessionUser->contains($sessionUser)) {
            $this->sessionUser->add($sessionUser);
        }

        return $this;
    }

    public function removeSessionUser(User $sessionUser): self
    {
        $this->sessionUser->removeElement($sessionUser);

        return $this;
    }
}
