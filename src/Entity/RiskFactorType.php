<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RiskFactorTypeRepository")
 */
class RiskFactorType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RiskFactor", mappedBy="riskFactorType")
     */
    private $riskFactors;

    public function __construct()
    {
        $this->riskFactors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
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

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return Collection|RiskFactor[]
     */
    public function getRiskFactors(): Collection
    {
        return $this->riskFactors;
    }

    public function addRiskFactor(RiskFactor $riskFactor): self
    {
        if (!$this->riskFactors->contains($riskFactor)) {
            $this->riskFactors[] = $riskFactor;
            $riskFactor->setRiskFactorType($this);
        }

        return $this;
    }

    public function removeRiskFactor(RiskFactor $riskFactor): self
    {
        if ($this->riskFactors->contains($riskFactor)) {
            $this->riskFactors->removeElement($riskFactor);
            // set the owning side to null (unless already changed)
            if ($riskFactor->getRiskFactorType() === $this) {
                $riskFactor->setRiskFactorType(null);
            }
        }

        return $this;
    }
}
