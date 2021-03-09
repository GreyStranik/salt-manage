<?php

namespace App\Entity;

use App\Entity\Helpers\Soft;
use App\Repository\InstalledSoftwareRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;
/**
 * @ORM\Entity(repositoryClass=InstalledSoftwareRepository::class)
 * @ORM\Table(name="installed_software",
 *  indexes={
 *          @Index(name="idx_installed_software_version", columns={"version"})
 *     }
 * )
 */
class InstalledSoftware
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Minion::class, inversedBy="installedSoftware")
     * @ORM\JoinColumn(nullable=false)
     */
    private $minion;

    /**
     * @ORM\ManyToOne(targetEntity=Soft::class, inversedBy="installed")
     * @ORM\JoinColumn(nullable=false)
     */
    private $soft;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $size;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $version;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $InstalledAt;

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
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

    public function getSoft(): ?Soft
    {
        return $this->soft;
    }

    public function setSoft(?Soft $soft): self
    {
        $this->soft = $soft;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(?string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(?string $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function getInstalledAt(): ?\DateTimeInterface
    {
        return $this->InstalledAt;
    }

    public function setInstalledAt(?\DateTimeInterface $InstalledAt): self
    {
        $this->InstalledAt = $InstalledAt;

        return $this;
    }
}
