<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RiskFactorRepository")
 */
class RiskFactor
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Polimorphism")
     */
    private $polimorphism;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $scores;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RiskFactorType", inversedBy="riskFactors")
     * @ORM\JoinColumn(nullable=false)
     */
    private $riskFactorType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPolimorphism(): ?Polimorphism
    {
        return $this->polimorphism;
    }

    public function setPolimorphism(?Polimorphism $polimorphism): self
    {
        $this->polimorphism = $polimorphism;

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

    public function getScores(): ?int
    {
        return $this->scores;
    }

    public function setScores(int $scores): self
    {
        $this->scores = $scores;

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

    public function getRiskFactorType(): ?RiskFactorType
    {
        return $this->riskFactorType;
    }

    public function setRiskFactorType(?RiskFactorType $riskFactorType): self
    {
        $this->riskFactorType = $riskFactorType;

        return $this;
    }
}
