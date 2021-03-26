<?php

namespace App\Entity\Equipment;

use App\Repository\Equipment\PrinterRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;
/**
 * @ORM\Table(name="""equipment"".""printer""")
 * @ORM\Entity(repositoryClass=PrinterRepository::class)
 */
class Printer
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
    private $serial;

    /**
     * @ORM\ManyToOne(targetEntity=PrinterModel::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $model;

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getSerial(): ?string
    {
        return $this->serial;
    }

    public function setSerial(string $serial): self
    {
        $this->serial = $serial;

        return $this;
    }

    public function getModel(): ?PrinterModel
    {
        return $this->model;
    }

    public function setModel(?PrinterModel $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function __toString()
    {
        return $this->serial;
    }

}
