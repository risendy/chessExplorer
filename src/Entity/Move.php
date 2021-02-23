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
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $inCheck;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $inDraw;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $inCheckmate;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $inStalemate;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $flags;

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

    /**
     * @return mixed
     */
    public function getInCheck()
    {
        return $this->inCheck;
    }

    /**
     * @param mixed $inCheck
     */
    public function setInCheck($inCheck): void
    {
        $this->inCheck = $inCheck;
    }

    /**
     * @return mixed
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * @param mixed $flags
     */
    public function setFlags($flags): void
    {
        $this->flags = $flags;
    }

    /**
     * @return mixed
     */
    public function getInDraw()
    {
        return $this->inDraw;
    }

    /**
     * @param mixed $inDraw
     */
    public function setInDraw($inDraw): void
    {
        $this->inDraw = $inDraw;
    }

    /**
     * @return mixed
     */
    public function getInCheckmate()
    {
        return $this->inCheckmate;
    }

    /**
     * @param mixed $inCheckmate
     */
    public function setInCheckmate($inCheckmate): void
    {
        $this->inCheckmate = $inCheckmate;
    }

    /**
     * @return mixed
     */
    public function getInStalemate()
    {
        return $this->inStalemate;
    }

    /**
     * @param mixed $inStalemate
     */
    public function setInStalemate($inStalemate): void
    {
        $this->inStalemate = $inStalemate;
    }
}
