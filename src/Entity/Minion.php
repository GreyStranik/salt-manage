<?php

namespace App\Entity;

use App\Entity\Helpers\CpuModel;
use App\Entity\Helpers\Manufacturer;
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
    private $biosreleasedate;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $room;

    /**
     * @ORM\ManyToOne(targetEntity=Manufacturer::class, inversedBy="minions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $manufacturer;

    /**
     * @ORM\ManyToOne(targetEntity=CpuModel::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $cpu_model;

    public function __construct(UuidInterface $uuid)
    {
        $this->id = $uuid;
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


    public function getBiosreleasedate(): DateTimeInterface
    {
        return $this->biosreleasedate;
    }

    public function setBiosreleasedate(DateTimeInterface $biosreleasedate): self
    {
        $this->biosreleasedate = $biosreleasedate;

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

    public function getManufacturer(): ?Manufacturer
    {
        return $this->manufacturer;
    }

    public function setManufacturer(?Manufacturer $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    /**
     * @return CpuModel
     */
    public function getCpuModel(): CpuModel
    {
        return $this->cpu_model;
    }

    /**
     * @param CpuModel $cpu_model
     * @return $this
     */
    public function setCpuModel(CpuModel $cpu_model): self
    {
        $this->cpu_model = $cpu_model;

        return $this;
    }
}
