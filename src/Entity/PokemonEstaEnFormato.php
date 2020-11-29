<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PokemonEstaEnFormato
 *
 * @ORM\Table(name="pokemon_esta_en_formato", indexes={@ORM\Index(name="fk_Formato_has_Pokemon_Formato1_idx", columns={"Formato_id"}), @ORM\Index(name="fk_Formato_has_Pokemon_Pokemon1_idx", columns={"Pokemon_Idpoke"})})
 * @ORM\Entity(repositoryClass="App\Repository\Pokemon_esta_en_formatoRepository")
 */
class PokemonEstaEnFormato
{
    /**
     * @var float
     *
     * @ORM\Column(name="Porcentaje_uso", type="float", precision=10, scale=0, nullable=false)
     *
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $porcentajeUso;

    /**
     * @var \Formato
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Formato")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Formato_id", referencedColumnName="Id")
     * })
     */
    private $formato;

    /**
     * @var \Pokemon
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Pokemon")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Pokemon_Idpoke", referencedColumnName="Idpoke")
     * })
     */
    private $pokemonIdpoke;

    public function getPorcentajeUso(): ?float
    {
        return $this->porcentajeUso;
    }

    public function setPorcentajeUso(String $porcentaje): self
    {
        $this->porcentajeUso = $porcentaje;

        return $this;
    }

    public function getFormato(): ?Formato
    {
        return $this->formato;
    }

    public function setFormato(?Formato $formato): self
    {
        $this->formato = $formato;

        return $this;
    }

    public function getPokemonIdpoke(): ?Pokemon
    {
        return $this->pokemonIdpoke;
    }

    public function setPokemonIdpoke(?Pokemon $pokemonIdpoke): self
    {
        $this->pokemonIdpoke = $pokemonIdpoke;

        return $this;
    }


}
