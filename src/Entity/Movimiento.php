<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Movimiento
 *
 * @ORM\Table(name="movimiento", uniqueConstraints={@ORM\UniqueConstraint(name="Nombre_UNIQUE", columns={"Nombre"})}, indexes={@ORM\Index(name="fk_Movimiento_Tipo1_idx", columns={"Tipo_Nombre"})})
 * @ORM\Entity
 * @UniqueEntity(fields={"nombre"}, message="Ya hay un movimiento que se llama así.")
 */
class Movimiento
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_mov", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMov;

    /**
     * @var string
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @Assert\Length(min=2,max=40,minMessage="Longitud mínima 2 caracteres",maxMessage="Longitud máxima 40 carácteres")
     * @Assert\Regex(
     *      pattern="/^[ÁÉÍÓÚA-Z]+/",
     *      message="El valor no puede ser un valor numérico/no emmpieza por mayúscula."
     * )
     * @ORM\Column(name="Nombre", type="string", length=40, nullable=false)
     */
    private $nombre;

    /**
     * @var \Tipo
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @ORM\ManyToOne(targetEntity="Tipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tipo_Nombre", referencedColumnName="Nombre")
     * })
     */
    private $tipoNombre;

    public function getIdMov(): ?int
    {
        return $this->idMov;
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

    public function getTipoNombre(): ?Tipo
    {
        return $this->tipoNombre;
    }

    public function setTipoNombre(?Tipo $tipoNombre): self
    {
        $this->tipoNombre = $tipoNombre;

        return $this;
    }

    public function __toString()
    {
        return $this->nombre;
    }

}
