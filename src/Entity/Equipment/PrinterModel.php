<?php

namespace App\Entity\Equipment;

use App\Entity\Helpers\Vendor;
use App\Repository\Equipment\PrinterModelRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Table(name="""equipment"".""printer_model""")
 * @ORM\Entity(repositoryClass=PrinterModelRepository::class)
 */
class PrinterModel
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
     * @ORM\ManyToOne(targetEntity=Vendor::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $vendor;

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

    public function getVendor(): ?Vendor
    {
        return $this->vendor;
    }

    public function setVendor(?Vendor $vendor): self
    {
        $this->vendor = $vendor;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
