<?php

namespace App\Entity;

use App\Repository\DiskRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=DiskRepository::class)
 * @ORM\Table(name="disk",
 *  indexes={
 *          @Index(name="idx_disk_name", columns={"name"})
 *     }
 * )
 */
class Disk
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @ORM\Column(type="bigint")
     */
    private $used;

    /**
     * @ORM\Column(type="bigint")
     */
    private $available;

    /**
     * @ORM\Column(type="bigint")
     */
    private $blocks;

    /**
     * @ORM\Column(type="text")
     */
    private $filesystem;

    /**
     * @ORM\ManyToOne(targetEntity=Minion::class, inversedBy="disks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $minion;

    /**
     * @ORM\Column(type="text")
     */
    private $capacity;

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
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

    public function getUsed(): ?string
    {
        return $this->used;
    }

    public function setUsed(string $used): self
    {
        $this->used = $used;

        return $this;
    }

    public function getAvailable(): ?string
    {
        return $this->available;
    }

    public function setAvailable(string $available): self
    {
        $this->available = $available;

        return $this;
    }

    public function getBlocks(): ?string
    {
        return $this->blocks;
    }

    public function setBlocks(string $blocks): self
    {
        $this->blocks = $blocks;

        return $this;
    }

    public function getFilesystem(): ?string
    {
        return $this->filesystem;
    }

    public function setFilesystem(string $filesystem): self
    {
        $this->filesystem = $filesystem;

        return $this;
    }

    public function getMinion(): ?Minion
    {
        return $this->minion;
    }

    public function setMinion(?Minion $minion): self
    {
        $this->minion = $minion;

        return $this;
    }

    public function getCapacity(): ?string
    {
        return $this->capacity;
    }

    public function setCapacity(string $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }
}
