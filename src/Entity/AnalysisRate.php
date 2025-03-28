<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Предельные нормальные значения анализа
 * @ORM\Entity(repositoryClass="App\Repository\AnalysisRateRepository")
 */
class AnalysisRate
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", options={"comment"="Ключ нормальных значений"})
     */
    private $id;

    /**
     * @ORM\Column(type="float", options={"comment"="Минимальное нормальное значение"})
     */
    private $rateMin;

    /**
     * @ORM\Column(type="float", options={"comment"="Максимальное нормальное значение"})
     */
    private $rateMax;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Analysis", inversedBy="analysisRates")
     * @ORM\JoinColumn(nullable=false)
     */
    private $analysis;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trimester")
     * @ORM\JoinColumn(nullable=false)
     */
    private $trimester;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Measure")
     * @ORM\JoinColumn(nullable=false)
     */
    private $measure;

    /**
     * @ORM\Column(type="boolean", options={"comment"="Ограничение использования", "default"=true})
     */
    private $enabled;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRateMin(): ?float
    {
        return $this->rateMin;
    }

    public function setRateMin(float $rateMin): self
    {
        $this->rateMin = $rateMin;

        return $this;
    }

    public function getRateMax(): ?float
    {
        return $this->rateMax;
    }

    public function setRateMax(float $rateMax): self
    {
        $this->rateMax = $rateMax;

        return $this;
    }

    public function getAnalysis(): ?Analysis
    {
        return $this->analysis;
    }

    public function setAnalysis(?Analysis $analysis): self
    {
        $this->analysis = $analysis;

        return $this;
    }

    public function getTrimester(): ?Trimester
    {
        return $this->trimester;
    }

    public function setTrimester(?Trimester $trimester): self
    {
        
        $this->trimester = $trimester;

        return $this;
    }

    public function getMeasure(): ?Measure
    {
        return $this->measure;
    }

    public function setMeasure(?Measure $measure): self
    {
        $this->measure = $measure;

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
}
