<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Movimiento
 *
 * @ORM\Table(name="movimiento", uniqueConstraints={@ORM\UniqueConstraint(name="Nombre_UNIQUE", columns={"Nombre"})}, indexes={@ORM\Index(name="fk_Movimiento_Tipo1_idx", columns={"Tipo_Nombre"})})
 * @ORM\Entity
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
     *
     * @ORM\Column(name="Nombre", type="string", length=40, nullable=false)
     */
    private $nombre;

    /**
     * @var \Tipo
     *
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
