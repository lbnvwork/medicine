<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 */
class Role
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", options={"comment"="Ключ роли"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, options={"comment"="Название роли"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50, nullable=true, options={"comment"="Техническое название"})
     */
    private $tech_name;

    /**
     * @ORM\Column(type="text", nullable=true, options={"comment"="Описание роли"})
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", options={"comment"="Ограничение использования", "default"=1})
     */
    private $enabled;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTechName(): ?string
    {
        return $this->tech_name;
    }

    public function setTechName(?string $tech_name): self
    {
        $this->tech_name = $tech_name;

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
}
