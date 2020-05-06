<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Сдача анализов пациента
 * @ORM\Entity(repositoryClass="App\Repository\PatientTestingRepository")
 */
class PatientTesting
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", options={"comment"="Ключ сдачи анализов"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patient", inversedBy="patientTestings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patient;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AnalysisGroup")
     * @ORM\JoinColumn(nullable=false)
     */
    private $analysisGroup;

    /**
     * @ORM\Column(type="date", nullable=true, options={"comment"="Дата проведенного тестирования"})
     */
    private $analysisDate;

    /**
     * @ORM\Column(type="integer", options={"comment"="Срок гестации для начала сдачи анализа"})
     */
    private $gestationalMinAge;

    /**
     * @ORM\Column(type="integer", options={"comment"="Срок гестации для окончания сдачи анализа"})
     */
    private $gestationalMaxAge;

    /**
     * @ORM\Column(type="boolean", options={"comment"="Статус принятия в работу врачом", "default"=false})
     */
    private $processed;

    /**
     * @ORM\Column(type="boolean", options={"comment"="Ограничение использования", "default"=true})
     */
    private $enabled;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PatientTestingResult", mappedBy="patientTesting", orphanRemoval=true)
     */
    private $patientTestingResults;

    public function __construct()
    {
        $this->patientTestingResults = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getAnalysisGroup(): ?AnalysisGroup
    {
        return $this->analysisGroup;
    }

    public function setAnalysisGroup(?AnalysisGroup $analysisGroup): self
    {
        $this->analysisGroup = $analysisGroup;

        return $this;
    }

    public function getAnalysisDate(): ?\DateTimeInterface
    {
        return $this->analysisDate;
    }

    public function setAnalysisDate(?\DateTimeInterface $analysisDate): self
    {
        $this->analysisDate = $analysisDate;

        return $this;
    }

    public function getGestationalMinAge(): ?int
    {
        return $this->gestationalMinAge;
    }

    public function setGestationalMinAge(int $gestationalMinAge): self
    {
        $this->gestationalMinAge = $gestationalMinAge;

        return $this;
    }

    public function getGestationalMaxAge(): ?int
    {
        return $this->gestationalMaxAge;
    }

    public function setGestationalMaxAge(int $gestationalMaxAge): self
    {
        $this->gestationalMaxAge = $gestationalMaxAge;

        return $this;
    }

    public function getProcessed(): ?bool
    {
        return $this->processed;
    }

    public function setProcessed(bool $processed): self
    {
        $this->processed = $processed;

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
     * @return Collection|PatientTestingResult[]
     */
    public function getPatientTestingResults(): Collection
    {
        return $this->patientTestingResults;
    }

    public function addPatientTestingResult(PatientTestingResult $patientTestingResult): self
    {
        if (!$this->patientTestingResults->contains($patientTestingResult)) {
            $this->patientTestingResults[] = $patientTestingResult;
            $patientTestingResult->setPatientTesting($this);
        }

        return $this;
    }

    public function removePatientTestingResult(PatientTestingResult $patientTestingResult): self
    {
        if ($this->patientTestingResults->contains($patientTestingResult)) {
            $this->patientTestingResults->removeElement($patientTestingResult);
            // set the owning side to null (unless already changed)
            if ($patientTestingResult->getPatientTesting() === $this) {
                $patientTestingResult->setPatientTesting(null);
            }
        }

        return $this;
    }
}
