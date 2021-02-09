<?php

namespace App\Entity;

use App\Repository\IPsRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=IPsRepository::class)
 */
class IPs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private $id;

    /**
     * @ORM\Column(type="inet")
     */
    private $ip_address;

    /**
     * @ORM\ManyToOne(targetEntity=Network::class, inversedBy="ips")
     * @ORM\JoinColumn(nullable=false)
     */
    private $network;

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getIpAddress()
    {
        return $this->ip_address;
    }

    public function setIpAddress($ip_address): self
    {
        $this->ip_address = $ip_address;

        return $this;
    }

    public function getNetwork(): ?Network
    {
        return $this->network;
    }

    public function setNetwork(?Network $network): self
    {
        $this->network = $network;

        return $this;
    }
}
