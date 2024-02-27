<?php

namespace App\Entity\CarUtils;

use App\Entity\SubModel;
use App\Repository\CarUtils\EngineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EngineRepository::class)]
class Engine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $ref = null;

    #[ORM\Column]
    private ?float $size = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $cylinders = null;

    #[ORM\Column(length: 100)]
    private ?string $fuel = null;

    #[ORM\Column]
    private ?int $power = null;

    #[ORM\OneToMany(targetEntity: SubModel::class, mappedBy: 'engine')]
    private Collection $subModels;

    public function __construct()
    {
        $this->subModels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): static
    {
        $this->ref = $ref;

        return $this;
    }

    public function getSize(): ?float
    {
        return $this->size;
    }

    public function setSize(float $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getCylinders(): ?int
    {
        return $this->cylinders;
    }

    public function setCylinders(int $cylinders): static
    {
        $this->cylinders = $cylinders;

        return $this;
    }

    public function getFuel(): ?string
    {
        return $this->fuel;
    }

    public function setFuel(string $fuel): static
    {
        $this->fuel = $fuel;

        return $this;
    }

    public function getPower(): ?int
    {
        return $this->power;
    }

    public function setPower(int $power): static
    {
        $this->power = $power;

        return $this;
    }

    /**
     * @return Collection<int, SubModel>
     */
    public function getSubModels(): Collection
    {
        return $this->subModels;
    }

    public function addSubModel(SubModel $subModel): static
    {
        if (!$this->subModels->contains($subModel)) {
            $this->subModels->add($subModel);
            $subModel->setEngine($this);
        }

        return $this;
    }

    public function removeSubModel(SubModel $subModel): static
    {
        if ($this->subModels->removeElement($subModel)) {
            // set the owning side to null (unless already changed)
            if ($subModel->getEngine() === $this) {
                $subModel->setEngine(null);
            }
        }

        return $this;
    }
}
