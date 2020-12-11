<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Habilidad
 *
 * @ORM\Table(name="habilidad", uniqueConstraints={@ORM\UniqueConstraint(name="Nombre_UNIQUE", columns={"Nombre"})})
 * @ORM\Entity
 * @UniqueEntity(fields={"nombre"}, message="Ya hay una habilidad que se llama así.")
 */
class Habilidad
{
    /**
     * @var int
     *
     * @ORM\Column(name="Idhabilidad", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idhabilidad;

    /**
     * @var string
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @Assert\Length(min=2,max=20,minMessage="Longitud mínima 2 caracteres",maxMessage="Longitud máxima 20 carácteres")
     * @Assert\Regex(
     *      pattern="/^[ÁÉÍÓÚA-Z]+/",
     *      message="El valor no puede ser un valor numérico/no emmpieza por mayúscula."
     * )
     * @ORM\Column(name="Nombre", type="string", length=60, nullable=false)
     */
    private $nombre;

    public function getIdhabilidad(): ?int
    {
        return $this->idhabilidad;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function __toString()
    {
        return $this->idhabilidad."";
    }

}
