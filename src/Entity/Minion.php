<?php

namespace App\Entity;

use App\Entity\Helpers\CpuModel;
use App\Entity\Helpers\Department;
use App\Entity\Helpers\Manufacturer;
use App\Entity\Helpers\Os;
use App\Entity\Helpers\OsFullName;
use App\Entity\Helpers\ProductName;
use App\Entity\Helpers\Type;
use App\Entity\Helpers\TypeDep;
use App\Repository\MinionRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass=MinionRepository::class)
 * @ORM\Table(name="minion", indexes={
 *          @Index(name="idx_minion_os_release", columns={"osrelease"})
 *     })
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
    private $serialnumber;

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
     * @MaxDepth(2)
     */
    private $manufacturer;

    /**
     * @ORM\ManyToOne(targetEntity=CpuModel::class)
     * @ORM\JoinColumn(nullable=false)
     * @MaxDepth(2)
     */
    private $cpu_model;

    /**
     * @ORM\ManyToOne(targetEntity=ProductName::class, inversedBy="minions")
     * @ORM\JoinColumn(nullable=false)
     * @MaxDepth(2)
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
     * @MaxDepth(2)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=TypeDep::class)
     * @ORM\JoinColumn(nullable=false)
     * @MaxDepth(2)
     */
    private $type_dep;

    /**
     * @ORM\ManyToOne(targetEntity=Department::class)
     * @ORM\JoinColumn(nullable=false)
     * @MaxDepth(2)
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

    /**
     * @ORM\OneToMany(targetEntity=Network::class, mappedBy="minion")
     * @MaxDepth(2)
     */
    private $networks;

    /**
     * @ORM\OneToMany(targetEntity=InstalledSoftware::class, mappedBy="minion")
     * @MaxDepth(2)
     */
    private $installedSoftware;

    /**
     * @ORM\OneToMany(targetEntity=Disk::class, mappedBy="minion")
     * @MaxDepth(2)
     */
    private $disks;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @MaxDepth(2)
     */
    private $osrelease;

    /**
     * @ORM\ManyToOne(targetEntity=Os::class, inversedBy="minions")
     * @MaxDepth(2)
     */
    private $os;

    /**
     * @ORM\ManyToOne(targetEntity=OsFullName::class, inversedBy="minions")
     * @MaxDepth(2)
     */
    private $os_full_name;

    /**
     * @ORM\OneToMany(targetEntity=AssignedStates::class, mappedBy="minion")
     */
    private $assignedStates;

    /**
     * @ORM\OneToMany(targetEntity=ConnectedMonitors::class, mappedBy="minion")
     */
    private $connectedMonitors;

    /**
     * @ORM\OneToMany(targetEntity=ConnectedPrinters::class, mappedBy="minion")
     */
    private $connectedPrinters;

    public function __construct(UuidInterface $uuid)
    {
        $this->id = $uuid;
        $this->networks = new ArrayCollection();
        $this->installedSoftware = new ArrayCollection();
        $this->disks = new ArrayCollection();
        $this->assignedStates = new ArrayCollection();
        $this->connectedMonitors = new ArrayCollection();
        $this->connectedPrinters = new ArrayCollection();
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

    public function getSerialnumber(): ?string
    {
        return $this->serialnumber;
    }

    public function setSerialnumber(string $serialnumber): self
    {
        $this->serialnumber = $serialnumber;

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

    /**
     * @return Collection|Network[]
     */
    public function getNetworks(): Collection
    {
        return $this->networks;
    }

    public function addNetwork(Network $network): self
    {
        if (!$this->networks->contains($network)) {
            $this->networks[] = $network;
            $network->setMinion($this);
        }

        return $this;
    }

    public function removeNetwork(Network $network): self
    {
        if ($this->networks->removeElement($network)) {
            // set the owning side to null (unless already changed)
            if ($network->getMinion() === $this) {
                $network->setMinion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|InstalledSoftware[]
     */
    public function getInstalledSoftware(): Collection
    {
        return $this->installedSoftware;
    }

    public function addInstalledSoftware(InstalledSoftware $installedSoftware): self
    {
        if (!$this->installedSoftware->contains($installedSoftware)) {
            $this->installedSoftware[] = $installedSoftware;
            $installedSoftware->setMinion($this);
        }

        return $this;
    }

    public function removeInstalledSoftware(InstalledSoftware $installedSoftware): self
    {
        if ($this->installedSoftware->removeElement($installedSoftware)) {
            // set the owning side to null (unless already changed)
            if ($installedSoftware->getMinion() === $this) {
                $installedSoftware->setMinion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Disk[]
     */
    public function getDisks(): Collection
    {
        return $this->disks;
    }

    public function addDisk(Disk $disk): self
    {
        if (!$this->disks->contains($disk)) {
            $this->disks[] = $disk;
            $disk->setMinion($this);
        }

        return $this;
    }

    public function removeDisk(Disk $disk): self
    {
        if ($this->disks->removeElement($disk)) {
            // set the owning side to null (unless already changed)
            if ($disk->getMinion() === $this) {
                $disk->setMinion(null);
            }
        }

        return $this;
    }

    public function getOsrelease(): ?string
    {
        return $this->osrelease;
    }

    public function setOsrelease(?string $osrelease): self
    {
        $this->osrelease = $osrelease;

        return $this;
    }

    public function getOs(): ?Os
    {
        return $this->os;
    }

    public function setOs(?Os $os): self
    {
        $this->os = $os;

        return $this;
    }

    public function getOsFullName(): ?OsFullName
    {
        return $this->os_full_name;
    }

    public function setOsFullName(?OsFullName $os_full_name): self
    {
        $this->os_full_name = $os_full_name;

        return $this;
    }

    /**
     * @return Collection|AssignedStates[]
     */
    public function getAssignedStates(): Collection
    {
        return $this->assignedStates;
    }

    public function addAssignedState(AssignedStates $assignedState): self
    {
        if (!$this->assignedStates->contains($assignedState)) {
            $this->assignedStates[] = $assignedState;
            $assignedState->setMinion($this);
        }

        return $this;
    }

    public function removeAssignedState(AssignedStates $assignedState): self
    {
        if ($this->assignedStates->removeElement($assignedState)) {
            // set the owning side to null (unless already changed)
            if ($assignedState->getMinion() === $this) {
                $assignedState->setMinion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ConnectedMonitors[]
     */
    public function getConnectedMonitors(): Collection
    {
        return $this->connectedMonitors;
    }

    public function addConnectedMonitor(ConnectedMonitors $connectedMonitor): self
    {
        if (!$this->connectedMonitors->contains($connectedMonitor)) {
            $this->connectedMonitors[] = $connectedMonitor;
            $connectedMonitor->setMinion($this);
        }

        return $this;
    }

    public function removeConnectedMonitor(ConnectedMonitors $connectedMonitor): self
    {
        if ($this->connectedMonitors->removeElement($connectedMonitor)) {
            // set the owning side to null (unless already changed)
            if ($connectedMonitor->getMinion() === $this) {
                $connectedMonitor->setMinion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ConnectedPrinters[]
     */
    public function getConnectedPrinters(): Collection
    {
        return $this->connectedPrinters;
    }

    public function addConnectedPrinter(ConnectedPrinters $connectedPrinter): self
    {
        if (!$this->connectedPrinters->contains($connectedPrinter)) {
            $this->connectedPrinters[] = $connectedPrinter;
            $connectedPrinter->setMinion($this);
        }

        return $this;
    }

    public function removeConnectedPrinter(ConnectedPrinters $connectedPrinter): self
    {
        if ($this->connectedPrinters->removeElement($connectedPrinter)) {
            // set the owning side to null (unless already changed)
            if ($connectedPrinter->getMinion() === $this) {
                $connectedPrinter->setMinion(null);
            }
        }

        return $this;
    }
}
