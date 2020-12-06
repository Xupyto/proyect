<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsuarioRepository")
 * @UniqueEntity(fields={"email"}, message="Ya hay una cuenta con ese email.")
 */
class Usuario implements UserInterface
{
    /**
     * @var string
     *
     * 
     * @ORM\Id
     * @Assert\NotBlank
     * @Assert\Email(
     *          message = "El email {{ value }} no es válido."
     * )
     * @Assert\Length(
     *          min = 5,
     *          max = 50,
     *          minMessage = "Tu email debe tener mínimo {{ limit }} caracteres.",
     *          maxMessage = "Tu email puede tener máximo {{ limit }} caracteres."
     * )
     * 
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *          min = 4,
     *          max = 20,
     *          minMessage = "Tu contraseña debe tener mínimo {{ limit }} caracteres.",
     *          maxMessage = "Tu contraseña puede tener máximo {{ limit }} caracteres."
     * )
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];



    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRol(): void
    {
        $this->roles[] = 'ROLE_USER';
    }

     /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
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

    public function __toString()
    {
        return $this->email;
    }

}
