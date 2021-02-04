<?php

namespace App\Entity;

use App\Repository\MoveRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MoveRepository::class)
 */
class Move
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $moveNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $moveSan;

    /**
     * @ORM\ManyToOne(targetEntity=Game::class, inversedBy="moves")
     */
    private $gameFk;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fen;

    /**
     * @ORM\OneToOne(targetEntity=Move::class, cascade={"persist", "remove"})
     */
    private $nextMove;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMoveNumber(): ?int
    {
        return $this->moveNumber;
    }

    public function setMoveNumber(?int $moveNumber): self
    {
        $this->moveNumber = $moveNumber;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getMoveSan(): ?string
    {
        return $this->moveSan;
    }

    public function setMoveSan(?string $moveSan): self
    {
        $this->moveSan = $moveSan;

        return $this;
    }

    public function getGameFk(): ?Game
    {
        return $this->gameFk;
    }

    public function setGameFk(?Game $gameFk): self
    {
        $this->gameFk = $gameFk;

        return $this;
    }

    public function getFen(): ?string
    {
        return $this->fen;
    }

    public function setFen(?string $fen): self
    {
        $this->fen = $fen;

        return $this;
    }

    public function getNextMove(): ?self
    {
        return $this->nextMove;
    }

    public function setNextMove(?self $nextMove): self
    {
        $this->nextMove = $nextMove;

        return $this;
    }
}
