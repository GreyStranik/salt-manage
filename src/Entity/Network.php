<?php

namespace App\Entity;

use App\Repository\NetworkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\DBAL\PostgresTypes\InetType;
use Doctrine\DBAL\PostgresTypes\MacAddrType;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=NetworkRepository::class)
 */
class Network
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Minion::class, inversedBy="networks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $minion;

    /**
     * @ORM\Column(type="text")
     */
    private $interface;

    /**
     * @ORM\Column(type="macaddr", length=255)
     */
    private $mac_address;

    /**
     * @ORM\OneToMany(targetEntity=IPs::class, mappedBy="network")
     */
    private $ips;

    public function __construct()
    {
        $this->ips = new ArrayCollection();
    }

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

    public function getInterface(): ?string
    {
        return $this->interface;
    }

    public function setInterface(string $interface): self
    {
        $this->interface = $interface;

        return $this;
    }

    public function getMacAddress(): ?string
    {
        return $this->mac_address;
    }

    public function setMacAddress(string $mac_address): self
    {
        $this->mac_address = $mac_address;

        return $this;
    }

    /**
     * @return Collection|IPs[]
     */
    public function getIps(): Collection
    {
        return $this->ips;
    }

    public function addIp(IPs $ip): self
    {
        if (!$this->ips->contains($ip)) {
            $this->ips[] = $ip;
            $ip->setNetwork($this);
        }

        return $this;
    }

    public function removeIp(IPs $ip): self
    {
        if ($this->ips->removeElement($ip)) {
            // set the owning side to null (unless already changed)
            if ($ip->getNetwork() === $this) {
                $ip->setNetwork(null);
            }
        }

        return $this;
    }


}
