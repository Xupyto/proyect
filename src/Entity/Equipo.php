<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipo
 *
 * @ORM\Table(name="equipo", indexes={@ORM\Index(name="fk_Equipo_Usuario1_idx", columns={"Usuario_email"})})
 * @ORM\Entity
 */
class Equipo
{
    /**
     * @var int
     *
     * @ORM\Column(name="idequipo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idequipo;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var \Usuario
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Usuario_email", referencedColumnName="email")
     * })
     */
    private $usuarioEmail;

    public function getIdequipo(): ?int
    {
        return $this->idequipo;
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

    public function getUsuarioEmail(): ?Usuario
    {
        return $this->usuarioEmail;
    }

    public function setUsuarioEmail(?Usuario $usuarioEmail): self
    {
        $this->usuarioEmail = $usuarioEmail;

        return $this;
    }


}
