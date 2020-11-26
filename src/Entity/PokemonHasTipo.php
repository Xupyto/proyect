<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PokemonHasTipo
 *
 * @ORM\Table(name="pokemon_has _tipo", indexes={@ORM\Index(name="nombre_tipo_fk_idx", columns={"nombre"})})
 * @ORM\Entity
 */
class PokemonHasTipo
{
    /**
     * @var int
     *
     * @ORM\Column(name="idpoke", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idpoke;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=25, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $nombre;

    public function getIdpoke(): ?int
    {
        return $this->idpoke;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?Tipo $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function setidpoke(?Pokemon $idpoke): self
    {
        $this->idpoke = $idpoke;

        return $this;
    }


}
