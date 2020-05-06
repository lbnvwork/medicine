<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\StaffRepository")
 */
class Staff
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", options={"comment"="Ключ персонала"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Role")
     * @ORM\JoinColumn(nullable=false)
     */
    private $role;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hospital", inversedBy="staff")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hospital;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Position")
     * @ORM\JoinColumn(nullable=false)
     */
    private $position;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AuthUser", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $AuthUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
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

    public function getPosition(): ?Position
    {
        return $this->position;
    }

    public function setPosition(?Position $position): self
    {
        $this->position = $position;

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
}
