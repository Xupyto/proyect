<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Objeto
 *
 * @ORM\Table(name="objeto", uniqueConstraints={@ORM\UniqueConstraint(name="Nombre_UNIQUE", columns={"Nombre"})})
 * @ORM\Entity
 */
class Objeto
{
    /**
     * @var int
     *
     * @ORM\Column(name="Idobjeto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idobjeto;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    public function getIdobjeto(): ?int
    {
        return $this->idobjeto;
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
