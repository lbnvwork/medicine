<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\RegionRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegionRepository")
 */
class Region
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", options={"comment"="Ключ региона"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Country")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255, options={"comment"="Название региона"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=8, options={"comment"="Номер региона"}, nullable=true)
     */
    private $region_number;

    /**
     * @ORM\Column(type="boolean", options={"comment"="Ограничение использования", "default"=1})
     */
    private $enabled;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\City", mappedBy="region", orphanRemoval=true)
     */
    private $cities;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Hospital", mappedBy="region", orphanRemoval=true)
     */
    private $hospitals;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\District", mappedBy="region", orphanRemoval=true)
     */
    private $districts;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $oktmoRegionId;

    public function __construct()
    {
        $this->city = new ArrayCollection();
        $this->cities = new ArrayCollection();
        $this->hospitals = new ArrayCollection();
        $this->districts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

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

    public function getRegionNumber(): ?string
    {
        return $this->region_number;
    }

    public function setRegionNumber(?string $region_number): self
    {
        $this->region_number = $region_number;

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
     * @return Collection|City[]
     */
    public function getCities(): Collection
    {
        return $this->cities;
    }

    public function addCity(City $city): self
    {
        if (!$this->cities->contains($city)) {
            $this->cities[] = $city;
            $city->setRegion($this);
        }

        return $this;
    }

    public function removeCity(City $city): self
    {
        if ($this->cities->contains($city)) {
            $this->cities->removeElement($city);
            // set the owning side to null (unless already changed)
            if ($city->getRegion() === $this) {
                $city->setRegion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Hospital[]
     */
    public function getHospitals(): Collection
    {
        return $this->hospitals;
    }

    public function addHospital(Hospital $hospital): self
    {
        if (!$this->hospitals->contains($hospital)) {
            $this->hospitals[] = $hospital;
            $hospital->setRegion($this);
        }

        return $this;
    }

    public function removeHospital(Hospital $hospital): self
    {
        if ($this->hospitals->contains($hospital)) {
            $this->hospitals->removeElement($hospital);
            // set the owning side to null (unless already changed)
            if ($hospital->getRegion() === $this) {
                $hospital->setRegion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|District[]
     */
    public function getDistricts(): Collection
    {
        return $this->districts;
    }

    public function addDistrict(District $district): self
    {
        if (!$this->districts->contains($district)) {
            $this->districts[] = $district;
            $district->setRegion($this);
        }

        return $this;
    }

    public function removeDistrict(District $district): self
    {
        if ($this->districts->contains($district)) {
            $this->districts->removeElement($district);
            // set the owning side to null (unless already changed)
            if ($district->getRegion() === $this) {
                $district->setRegion(null);
            }
        }

        return $this;
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
}
