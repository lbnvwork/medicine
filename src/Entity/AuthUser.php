<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class AuthUser implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", options={"comment"="Ключ пользователя"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, nullable=true, options={"comment"="Email пользователя"})
     */
    private $email;

    /**
     * @ORM\Column(type="json", options={"comment"="Роли пользователя"})
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", nullable=true, options={"comment"="Пароль пользователя"})
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=12, unique=true, options={"comment"="Телефон пользователя"})
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=30, options={"comment"="Имя пользователя"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=100, options={"comment"="Фамилия пользователя"})
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=50, nullable=true, options={"comment"="Отчество пользователя"})
     */
    private $patronymicName;

    /**
     * @ORM\Column(type="text", nullable=true, options={"comment"="Описание/комментарий"})
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", options={"comment"="Ограничение использования", "default"=true})
     */
    private $enabled;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        //$roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(string $role): self
    {
        $this->roles = [$role];

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = '7'.$phone;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPatronymicName(): ?string
    {
        return $this->patronymicName;
    }

    public function setPatronymicName(?string $patronymicName): self
    {
        $this->patronymicName = $patronymicName;

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
