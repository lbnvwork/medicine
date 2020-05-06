<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PatientRepository")
 */
class Patient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", options={"comment"="Ключ пациента"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hospital", inversedBy="patients")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hospital;

    /**
     * @ORM\Column(type="string", length=20, nullable=true, options={"comment"="СНИЛС пациента"})
     */
    private $snils;

    /**
     * @ORM\Column(type="string", length=50, nullable=true, options={"comment"="Номер страховки"})
     */
    private $insuranceNumber;

    /**
     * @ORM\Column(type="date", nullable=true, options={"comment"="Дата рождения"})
     */
    private $dateBirth;

    /**
     * @ORM\Column(type="date", options={"comment"="Дата начала лечения"})
     */
    private $dateStartOfTreatment;

    /**
     * @ORM\Column(type="string", length=255, options={"comment"="Адрес пациента"})
     */
    private $address;

    /**
     * @ORM\Column(type="boolean", options={"comment"="Флаг оповещения через смс", "default"=1})
     */
    private $smsInforming;

    /**
     * @ORM\Column(type="boolean", options={"comment"="Флаг оповещения через email", "default"=1})
     */
    private $emailInforming;

    /**
     * @ORM\Column(type="text", nullable=true, options={"comment"="Важный комментарий для вывода"})
     */
    private $importantComment;

    /**
     * @ORM\Column(type="text", options={"comment"="Сопуствующее заболевание"})
     */
    private $concomitantDisease;

    /**
     * @ORM\Column(type="string", length=20, nullable=true, options={"comment"="Паспортный данные"})
     */
    private $passport;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AuthUser", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $AuthUser;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\City", inversedBy="patients")
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\District", inversedBy="patients")
     */
    private $district;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Polimorphism")
     */
    private $polimorphism;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Diagnosis")
     */
    private $diagnosis;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\RiskFactor")
     */
    private $riskFactor;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PatientTesting", mappedBy="patient", orphanRemoval=true)
     */
    private $patientTestings;

    public function __construct()
    {
        $this->polimorphism = new ArrayCollection();
        $this->diagnosis = new ArrayCollection();
        $this->riskFactor = new ArrayCollection();
        $this->patientTestings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHospital(): ?Hospital
    {
        return $this->hospital;
    }

    public function setHospital(?Hospital $hospital): self
    {
        $this->hospital = $hospital;

        return $this;
    }

    public function getSnils(): ?string
    {
        return $this->snils;
    }

    public function setSnils(string $snils): self
    {
        $this->snils = $snils;

        return $this;
    }

    public function getInsuranceNumber(): ?string
    {
        return $this->insuranceNumber;
    }

    public function setInsuranceNumber(?string $insuranceNumber): self
    {
        $this->insuranceNumber = $insuranceNumber;

        return $this;
    }

    public function getDateBirth(): ?\DateTimeInterface
    {
        return $this->dateBirth;
    }

    public function setDateBirth(?\DateTimeInterface $dateBirth): self
    {
        $this->dateBirth = $dateBirth;

        return $this;
    }

    public function getDateStartOfTreatment(): ?\DateTimeInterface
    {
        return $this->dateStartOfTreatment;
    }

    public function setDateStartOfTreatment(\DateTimeInterface $dateStartOfTreatment): self
    {
        $this->dateStartOfTreatment = $dateStartOfTreatment;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getSmsInforming(): ?bool
    {
        return $this->smsInforming;
    }

    public function setSmsInforming(bool $smsInforming): self
    {
        $this->smsInforming = $smsInforming;

        return $this;
    }

    public function getEmailInforming(): ?bool
    {
        return $this->emailInforming;
    }

    public function setEmailInforming(bool $emailInforming): self
    {
        $this->emailInforming = $emailInforming;

        return $this;
    }

    public function getImportantComment(): ?string
    {
        return $this->importantComment;
    }

    public function setImportantComment(?string $importantComment): self
    {
        $this->importantComment = $importantComment;

        return $this;
    }

    public function getConcomitantDisease(): ?string
    {
        return $this->concomitantDisease;
    }

    public function setConcomitantDisease(string $concomitantDisease): self
    {
        $this->concomitantDisease = $concomitantDisease;

        return $this;
    }

    public function getPassport(): ?string
    {
        return $this->passport;
    }

    public function setPassport(string $passport): self
    {
        $this->passport = $passport;

        return $this;
    }

    public function getAuthUser(): ?AuthUser
    {
        return $this->AuthUser;
    }

    public function setAuthUser(AuthUser $AuthUser): self
    {
        $this->AuthUser = $AuthUser;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getDistrict(): ?District
    {
        return $this->district;
    }

    public function setDistrict(?District $district): self
    {
        $this->district = $district;

        return $this;
    }

    /**
     * @return Collection|Polimorphism[]
     */
    public function getPolimorphism(): Collection
    {
        return $this->polimorphism;
    }

    public function addPolimorphism(Polimorphism $polimorphism): self
    {
        if (!$this->polimorphism->contains($polimorphism)) {
            $this->polimorphism[] = $polimorphism;
        }

        return $this;
    }

    public function removePolimorphism(Polimorphism $polimorphism): self
    {
        if ($this->polimorphism->contains($polimorphism)) {
            $this->polimorphism->removeElement($polimorphism);
        }

        return $this;
    }

    /**
     * @return Collection|Diagnosis[]
     */
    public function getDiagnosis(): Collection
    {
        return $this->diagnosis;
    }

    public function addDiagnosi(Diagnosis $diagnosis): self
    {
        if (!$this->diagnosis->contains($diagnosis)) {
            $this->diagnosis[] = $diagnosis;
        }

        return $this;
    }

    public function removeDiagnosi(Diagnosis $diagnosis): self
    {
        if ($this->diagnosis->contains($diagnosis)) {
            $this->diagnosis->removeElement($diagnosis);
        }

        return $this;
    }

    /**
     * @return Collection|RiskFactor[]
     */
    public function getRiskFactor(): Collection
    {
        return $this->riskFactor;
    }

    public function addRiskFactor(RiskFactor $riskFactor): self
    {
        if (!$this->riskFactor->contains($riskFactor)) {
            $this->riskFactor[] = $riskFactor;
        }

        return $this;
    }

    public function removeRiskFactor(RiskFactor $riskFactor): self
    {
        if ($this->riskFactor->contains($riskFactor)) {
            $this->riskFactor->removeElement($riskFactor);
        }

        return $this;
    }

    /**
     * @return Collection|PatientTesting[]
     */
    public function getPatientTestings(): Collection
    {
        return $this->patientTestings;
    }

    public function addPatientTesting(PatientTesting $patientTesting): self
    {
        if (!$this->patientTestings->contains($patientTesting)) {
            $this->patientTestings[] = $patientTesting;
            $patientTesting->setPatient($this);
        }

        return $this;
    }

    public function removePatientTesting(PatientTesting $patientTesting): self
    {
        if ($this->patientTestings->contains($patientTesting)) {
            $this->patientTestings->removeElement($patientTesting);
            // set the owning side to null (unless already changed)
            if ($patientTesting->getPatient() === $this) {
                $patientTesting->setPatient(null);
            }
        }

        return $this;
    }
}
