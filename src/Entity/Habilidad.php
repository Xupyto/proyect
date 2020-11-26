<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Habilidad
 *
 * @ORM\Table(name="habilidad", uniqueConstraints={@ORM\UniqueConstraint(name="Nombre_UNIQUE", columns={"Nombre"})})
 * @ORM\Entity
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
     *
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


}
