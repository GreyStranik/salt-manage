<?php

namespace App\Entity;

use App\Entity\Equipment\Printer;
use App\Repository\ConnectedPrintersRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=ConnectedPrintersRepository::class)
 */
class ConnectedPrinters
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Minion::class, inversedBy="connectedPrinters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $minion;

    /**
     * @ORM\ManyToOne(targetEntity=Printer::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $printer;

    /**
     * @ORM\Column(type="boolean")
     */
    private $connected;

    /**
     * @ORM\Column(type="datetime")
     */
    private $cdate;

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

    public function getPrinter(): ?Printer
    {
        return $this->printer;
    }

    public function setPrinter(?Printer $printer): self
    {
        $this->printer = $printer;

        return $this;
    }

    public function getConnected(): ?bool
    {
        return $this->connected;
    }

    public function setConnected(bool $connected): self
    {
        $this->connected = $connected;

        return $this;
    }

    public function getCdate(): ?\DateTimeInterface
    {
        return $this->cdate;
    }

    public function setCdate(\DateTimeInterface $cdate): self
    {
        $this->cdate = $cdate;

        return $this;
    }
}
