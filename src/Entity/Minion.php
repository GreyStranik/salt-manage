<?php

namespace App\Entity;

use App\Repository\MinionRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=MinionRepository::class)
 */
class Minion
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $node_name;

    /**
     * @ORM\Column(type="text")
     */
    private $selialnumber;

    /**
     * @ORM\Column(type="text")
     */
    private $biosversion;

    /**
     * @ORM\Column(type="date")
     */
    private $biosrealisedate;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $room;

    public function __construct()
    {
        //$this->id = Uuid::uuid4();
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getNodeName(): ?string
    {
        return $this->node_name;
    }

    public function setNodeName(string $node_name): self
    {
        $this->node_name = $node_name;

        return $this;
    }

    public function getSelialnumber(): ?string
    {
        return $this->selialnumber;
    }

    public function setSelialnumber(string $selialnumber): self
    {
        $this->selialnumber = $selialnumber;

        return $this;
    }

    public function getBiosversion(): ?string
    {
        return $this->biosversion;
    }

    public function setBiosversion(string $biosversion): self
    {
        $this->biosversion = $biosversion;

        return $this;
    }

    public function getBiosrealisedate(): ?DateTimeInterface
    {
        return $this->biosrealisedate;
    }

    public function setBiosrealisedate(DateTimeInterface $biosrealisedate): self
    {
        $this->biosrealisedate = $biosrealisedate;

        return $this;
    }

    public function getRoom(): ?string
    {
        return $this->room;
    }

    public function setRoom(?string $room): self
    {
        $this->room = $room;

        return $this;
    }
}
