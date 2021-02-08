<?php

namespace App\Entity;

use App\Entity\Helpers\CpuModel;
use App\Entity\Helpers\Department;
use App\Entity\Helpers\Manufacturer;
use App\Entity\Helpers\ProductName;
use App\Entity\Helpers\Type;
use App\Entity\Helpers\TypeDep;
use App\Repository\MinionRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=MinionRepository::class)
 */
class Minion
{

    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(type="uuid")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $node_name;

    /**
     * @ORM\Column(type="text")
     */
    private $selialnumber;

    /**
     * @ORM\Column(type="text")
     */
    private $biosversion;

    /**
     * @ORM\Column(type="date")
     */
    private $biosreleasedate;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $room;

    /**
     * @ORM\ManyToOne(targetEntity=Manufacturer::class, inversedBy="minions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $manufacturer;

    /**
     * @ORM\ManyToOne(targetEntity=CpuModel::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $cpu_model;

    /**
     * @ORM\ManyToOne(targetEntity=ProductName::class, inversedBy="minions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product_name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $fio_user;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $user_phone;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=TypeDep::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $type_dep;

    /**
     * @ORM\ManyToOne(targetEntity=Department::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $department;

    /**
     * @ORM\Column(type="text")
     */
    private $saltversion;

    /**
     * @ORM\Column(type="integer")
     */
    private $mem_total;

    public function __construct(UuidInterface $uuid)
    {
        $this->id = $uuid;
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getNodeName(): ?string
    {
        return $this->node_name;
    }

    public function setNodeName(string $node_name): self
    {
        $this->node_name = $node_name;

        return $this;
    }

    public function getSelialnumber(): ?string
    {
        return $this->selialnumber;
    }

    public function setSelialnumber(string $selialnumber): self
    {
        $this->selialnumber = $selialnumber;

        return $this;
    }

    public function getBiosversion(): ?string
    {
        return $this->biosversion;
    }

    public function setBiosversion(string $biosversion): self
    {
        $this->biosversion = $biosversion;

        return $this;
    }


    public function getBiosreleasedate(): DateTimeInterface
    {
        return $this->biosreleasedate;
    }

    public function setBiosreleasedate(DateTimeInterface $biosreleasedate): self
    {
        $this->biosreleasedate = $biosreleasedate;

        return $this;
    }

    public function getRoom(): ?string
    {
        return $this->room;
    }

    public function setRoom(?string $room): self
    {
        $this->room = $room;

        return $this;
    }

    public function getManufacturer(): ?Manufacturer
    {
        return $this->manufacturer;
    }

    public function setManufacturer(?Manufacturer $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    /**
     * @return CpuModel
     */
    public function getCpuModel(): CpuModel
    {
        return $this->cpu_model;
    }

    /**
     * @param CpuModel $cpu_model
     * @return $this
     */
    public function setCpuModel(CpuModel $cpu_model): self
    {
        $this->cpu_model = $cpu_model;

        return $this;
    }

    public function getProductName(): ?ProductName
    {
        return $this->product_name;
    }

    public function setProductName(?ProductName $product_name): self
    {
        $this->product_name = $product_name;

        return $this;
    }

    public function getFioUser(): ?string
    {
        return $this->fio_user;
    }

    public function setFioUser(?string $fio_user): self
    {
        $this->fio_user = $fio_user;

        return $this;
    }

    public function getUserPhone(): ?string
    {
        return $this->user_phone;
    }

    public function setUserPhone(?string $user_phone): self
    {
        $this->user_phone = $user_phone;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getTypeDep(): ?TypeDep
    {
        return $this->type_dep;
    }

    public function setTypeDep(?TypeDep $type_dep): self
    {
        $this->type_dep = $type_dep;

        return $this;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getSaltversion(): ?string
    {
        return $this->saltversion;
    }

    public function setSaltversion(string $saltversion): self
    {
        $this->saltversion = $saltversion;

        return $this;
    }

    public function getMemTotal(): ?int
    {
        return $this->mem_total;
    }

    public function setMemTotal(int $mem_total): self
    {
        $this->mem_total = $mem_total;

        return $this;
    }
}
