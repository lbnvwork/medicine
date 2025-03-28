<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HospitalRepository")
 */
class Hospital
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", options={"comment"="Ключ больницы"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Region", inversedBy="hospitals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $region;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\City", inversedBy="hospitals")
     * @ORM\JoinColumn(nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"comment"="Адрес больницы"})
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, options={"comment"="Название больницы"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50, options={"comment"="Телефон для отправки смс"})
     */
    private $phone;

    /**
     * @ORM\Column(type="text", nullable=true, options={"comment"="Описание или комментарий для больницы"})
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", options={"comment"="Ограничение использования", "default"=true})
     */
    private $enabled;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Staff", mappedBy="hospital")
     */
    private $staff;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Patient", mappedBy="hospital")
     */
    private $patients;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\LPU", cascade={"persist", "remove"})
     */
    private $lpu;

    public function __construct()
    {
        $this->staff = new ArrayCollection();
        $this->patients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
     * @return Collection|Staff[]
     */
    public function getStaff(): Collection
    {
        return $this->staff;
    }

    public function addStaff(Staff $staff): self
    {
        if (!$this->staff->contains($staff)) {
            $this->staff[] = $staff;
            $staff->setHospital($this);
        }

        return $this;
    }

    public function removeStaff(Staff $staff): self
    {
        if ($this->staff->contains($staff)) {
            $this->staff->removeElement($staff);
            // set the owning side to null (unless already changed)
            if ($staff->getHospital() === $this) {
                $staff->setHospital(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Patient[]
     */
    public function getPatients(): Collection
    {
        return $this->patients;
    }

    public function addPatient(Patient $patient): self
    {
        if (!$this->patients->contains($patient)) {
            $this->patients[] = $patient;
            $patient->setHospital($this);
        }

        return $this;
    }

    public function removePatient(Patient $patient): self
    {
        if ($this->patients->contains($patient)) {
            $this->patients->removeElement($patient);
            // set the owning side to null (unless already changed)
            if ($patient->getHospital() === $this) {
                $patient->setHospital(null);
            }
        }

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getLpu(): ?LPU
    {
        return $this->lpu;
    }

    public function setLpu(?LPU $lpu): self
    {
        $this->lpu = $lpu;

        return $this;
    }
}
