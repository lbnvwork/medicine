<?php

namespace App\Entity;


use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LPURepository")
 */
class LPU
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $oktmoRegionId;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $regionName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $years;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fullName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $caption;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $OKOPF;

    /**
     * @ORM\Column(type="string", length=6, nullable=true)
     */
    private $postCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $directorLastName;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $directorFirstName;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $directorPatronymicName;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $fax;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $license;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $licenseDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $licenseDateEnd;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $medicalCareTypes;

    /**
     * @ORM\Column(type="date")
     */
    private $includeDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOktmoRegionId(): ?int
    {
        return $this->oktmoRegionId;
    }

    public function setOktmoRegionId(?int $oktmoRegionId): self
    {
        $this->oktmoRegionId = $oktmoRegionId;

        return $this;
    }

    public function getRegionName(): ?string
    {
        return $this->regionName;
    }

    public function setRegionName(string $regionName): self
    {
        $this->regionName = $regionName;

        return $this;
    }

    public function getYears(): ?string
    {
        return $this->years;
    }

    public function setYears(string $years): self
    {
        $this->years = $years;

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

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(?string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }

    public function getOKOPF(): ?string
    {
        return $this->OKOPF;
    }

    public function setOKOPF(string $OKOPF): self
    {
        $this->OKOPF = $OKOPF;

        return $this;
    }

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    public function setPostCode(?string $postCode): self
    {
        $this->postCode = $postCode;

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

    public function getDirectorLastName(): ?string
    {
        return $this->directorLastName;
    }

    public function setDirectorLastName(string $directorLastName): self
    {
        $this->directorLastName = $directorLastName;

        return $this;
    }

    public function getDirectorFirstName(): ?string
    {
        return $this->directorFirstName;
    }

    public function setDirectorFirstName(string $directorFirstName): self
    {
        $this->directorFirstName = $directorFirstName;

        return $this;
    }

    public function getDirectorPatronymicName(): ?string
    {
        return $this->directorPatronymicName;
    }

    public function setDirectorPatronymicName(?string $directorPatronymicName): self
    {
        $this->directorPatronymicName = $directorPatronymicName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(?string $fax): self
    {
        $this->fax = $fax;

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

    public function getLicense(): ?string
    {
        return $this->license;
    }

    public function setLicense(string $license): self
    {
        $this->license = $license;

        return $this;
    }

    public function getLicenseDate(): ?\DateTimeInterface
    {
        return $this->licenseDate;
    }

    public function setLicenseDate(?string $licenseDate): self
    {
        $this->licenseDate = DateTime::createFromFormat('d.m.Y', $licenseDate) ? DateTime::createFromFormat('d.m.Y', $licenseDate) : null;

        return $this;
    }

    public function getLicenseDateEnd(): ?\DateTimeInterface
    {
        return $this->licenseDateEnd;
    }

    public function setLicenseDateEnd(?string $licenseDateEnd): self
    {
        $this->licenseDateEnd =  DateTime::createFromFormat('d.m.Y', $licenseDateEnd)?DateTime::createFromFormat('d.m.Y', $licenseDateEnd): null;

        return $this;
    }

    public function getMedicalCareTypes(): ?string
    {
        return $this->medicalCareTypes;
    }

    public function setMedicalCareTypes(?string $medicalCareTypes): self
    {
        $this->medicalCareTypes = $medicalCareTypes;

        return $this;
    }

    public function getIncludeDate(): ?\DateTimeInterface
    {
        return $this->includeDate;
    }

    public function setIncludeDate(?string $includeDate): self
    {
        $this->includeDate = DateTime::createFromFormat('d.m.Y', $includeDate) ? DateTime::createFromFormat('d.m.Y', $includeDate) : null;

        return $this;
    }
}
