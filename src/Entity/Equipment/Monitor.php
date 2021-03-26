<?php

namespace App\Entity\Equipment;

use App\Entity\Helpers\Vendor;
use App\Repository\Equipment\MonitorRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Table(name="""equipment"".""monitor""")
 * @ORM\Entity(repositoryClass=MonitorRepository::class)
 */
class Monitor
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
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\Column(type="integer")
     */
    private $week;

    /**
     * @ORM\ManyToOne(targetEntity=MonitorModels::class)
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

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getWeek(): ?int
    {
        return $this->week;
    }

    public function setWeek(int $week): self
    {
        $this->week = $week;

        return $this;
    }

    public function getModel(): ?MonitorModels
    {
        return $this->model;
    }

    public function setModel(?MonitorModels $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function __toString()
    {
        return $this->getSerial();
    }
}
