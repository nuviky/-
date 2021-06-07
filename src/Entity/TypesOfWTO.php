<?php

namespace App\Entity;

use App\Repository\TypesOfWTORepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypesOfWTORepository::class)
 */
class TypesOfWTO
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeWTO;

    /**
     * @ORM\OneToMany(targetEntity=AggregatesWTO::class, mappedBy="typesOfWTO")
     */
    private $relation;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeWTO(): ?string
    {
        return $this->typeWTO;
    }

    public function setTypeWTO(string $typeWTO): self
    {
        $this->typeWTO = $typeWTO;

        return $this;
    }

    /**
     * @return Collection|AggregatesWTO[]
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(AggregatesWTO $relation): self
    {
        if (!$this->relation->contains($relation)) {
            $this->relation[] = $relation;
            $relation->setTypesOfWTO($this);
        }

        return $this;
    }

    public function removeRelation(AggregatesWTO $relation): self
    {
        if ($this->relation->removeElement($relation)) {
            // set the owning side to null (unless already changed)
            if ($relation->getTypesOfWTO() === $this) {
                $relation->setTypesOfWTO(null);
            }
        }

        return $this;
    }
}