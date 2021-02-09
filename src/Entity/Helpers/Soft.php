<?php

namespace App\Entity\Helpers;

use App\Entity\InstalledSoftware;
use App\Repository\Helpers\SoftRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Table(name="""helpers"".""soft""")
 * @ORM\Entity(repositoryClass=SoftRepository::class)
 */
class Soft
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private $id;

    /**
     * @ORM\Column(type="text",unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=InstalledSoftware::class, mappedBy="soft")
     */
    private $installed;

    public function __construct()
    {
        $this->installed = new ArrayCollection();
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection|InstalledSoftware[]
     */
    public function getInstalled(): Collection
    {
        return $this->installed;
    }

    public function addInstalled(InstalledSoftware $installed): self
    {
        if (!$this->installed->contains($installed)) {
            $this->installed[] = $installed;
            $installed->setSoft($this);
        }

        return $this;
    }

    public function removeInstalled(InstalledSoftware $installed): self
    {
        if ($this->installed->removeElement($installed)) {
            // set the owning side to null (unless already changed)
            if ($installed->getSoft() === $this) {
                $installed->setSoft(null);
            }
        }

        return $this;
    }
}
