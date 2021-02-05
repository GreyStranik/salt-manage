<?php

namespace App\Entity\Helpers;

use App\Entity\Minion;
use App\Repository\Helpers\ManufacturerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;

/**
 * @ORM\Table(name="""helpers"".""manufacturer""")
 * @ORM\Entity(repositoryClass=ManufacturerRepository::class)
 */
class Manufacturer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private $id;

    /**
     * @ORM\Column(type="text", unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Minion::class, mappedBy="manufacturer")
     */
    private $minions;

    public function __construct()
    {
        $this->minions = new ArrayCollection();
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
     * @return Collection|Minion[]
     */
    public function getMinions(): Collection
    {
        return $this->minions;
    }

    public function addMinion(Minion $minion): self
    {
        if (!$this->minions->contains($minion)) {
            $this->minions[] = $minion;
            $minion->setManufacturer($this);
        }

        return $this;
    }

    public function removeMinion(Minion $minion): self
    {
        if ($this->minions->removeElement($minion)) {
            // set the owning side to null (unless already changed)
            if ($minion->getManufacturer() === $this) {
                $minion->setManufacturer(null);
            }
        }

        return $this;
    }
}
