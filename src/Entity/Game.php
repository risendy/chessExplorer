<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
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
    private $event;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $site;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $round;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $white;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $black;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $result;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $whiteElo;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $blackElo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $eco;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $eventDate;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $pgn;

    /**
     * @ORM\OneToMany(targetEntity=Move::class, mappedBy="gameFk")
     */
    private $moves;

    public function __construct()
    {
        $this->moves = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvent(): ?string
    {
        return $this->event;
    }

    public function setEvent(?string $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getSite(): ?string
    {
        return $this->site;
    }

    public function setSite(?string $site): self
    {
        $this->site = $site;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getRound(): ?string
    {
        return $this->round;
    }

    public function setRound(?string $round): self
    {
        $this->round = $round;

        return $this;
    }

    public function getWhite(): ?string
    {
        return $this->white;
    }

    public function setWhite(?string $white): self
    {
        $this->white = $white;

        return $this;
    }

    public function getBlack(): ?string
    {
        return $this->black;
    }

    public function setBlack(?string $black): self
    {
        $this->black = $black;

        return $this;
    }

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function setResult(?string $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function getWhiteElo(): ?float
    {
        return $this->whiteElo;
    }

    public function setWhiteElo(?float $whiteElo): self
    {
        $this->whiteElo = $whiteElo;

        return $this;
    }

    public function getBlackElo(): ?float
    {
        return $this->blackElo;
    }

    public function setBlackElo(?float $blackElo): self
    {
        $this->blackElo = $blackElo;

        return $this;
    }

    public function getEco(): ?string
    {
        return $this->eco;
    }

    public function setEco(?string $eco): self
    {
        $this->eco = $eco;

        return $this;
    }

    public function getEventDate(): ?\DateTimeInterface
    {
        return $this->eventDate;
    }

    public function setEventDate(?\DateTimeInterface $eventDate): self
    {
        $this->eventDate = $eventDate;

        return $this;
    }

    /**
     * @return Collection|Move[]
     */
    public function getMoves(): Collection
    {
        return $this->moves;
    }

    public function addMove(Move $move): self
    {
        if (!$this->moves->contains($move)) {
            $this->moves[] = $move;
            $move->setGameFk($this);
        }

        return $this;
    }

    public function removeMove(Move $move): self
    {
        if ($this->moves->removeElement($move)) {
            // set the owning side to null (unless already changed)
            if ($move->getGameFk() === $this) {
                $move->setGameFk(null);
            }
        }

        return $this;
    }

    public function getPgn(): ?string
    {
        return $this->pgn;
    }

    public function setPgn(?string $pgn): self
    {
        $this->pgn = $pgn;

        return $this;
    }
}
