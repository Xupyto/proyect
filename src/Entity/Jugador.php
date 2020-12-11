<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Jugador
 *
 * @ORM\Table(name="jugador")
 * @ORM\Entity
 * @UniqueEntity(fields={"nombre"}, message="Ya hay un objeto que se llama así.")
 */
class Jugador
{
    /**
     * @var int
     *
     * @ORM\Column(name="Idjugador", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idjugador;

    /**
     * @var string
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @Assert\Length(min=2,max=45,minMessage="Longitud mínima 2 caracteres",maxMessage="Longitud máxima 45 carácteres")
     * @Assert\Regex(
     *      pattern="/^[ÁÉÍÓÚA-Z]+/",
     *      message="El valor no puede ser un valor numérico/no emmpieza por mayúscula."
     * )
     * @ORM\Column(name="Nombre", type="string", length=30, nullable=false)
     */
    private $nombre;

    public function getIdjugador(): ?int
    {
        return $this->idjugador;
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
        return $this->nombre;
    }


}
