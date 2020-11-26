<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tipo
 *
 * @ORM\Table(name="tipo")
 * @ORM\Entity
 */
class Tipo
{
    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=25, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nombre;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Pokemon", mappedBy="tipoNombre")
     */
    private $pokemonIdpoke;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pokemonIdpoke = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    /**
     * @return Collection|Pokemon[]
     */
    public function getPokemonIdpoke(): Collection
    {
        return $this->pokemonIdpoke;
    }

    public function addPokemonIdpoke(Pokemon $pokemonIdpoke): self
    {
        if (!$this->pokemonIdpoke->contains($pokemonIdpoke)) {
            $this->pokemonIdpoke[] = $pokemonIdpoke;
            $pokemonIdpoke->addTipoNombre($this);
        }

        return $this;
    }

    public function removePokemonIdpoke(Pokemon $pokemonIdpoke): self
    {
        if ($this->pokemonIdpoke->contains($pokemonIdpoke)) {
            $this->pokemonIdpoke->removeElement($pokemonIdpoke);
            $pokemonIdpoke->removeTipoNombre($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nombre;
    }

}
