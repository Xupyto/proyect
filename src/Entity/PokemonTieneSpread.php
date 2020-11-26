<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PokemonTieneSpread
 *
 * @ORM\Table(name="pokemon_tiene_spread", indexes={@ORM\Index(name="fk_Pokemon_has_Spread_Formato1_idx", columns={"Formato_Id"}), @ORM\Index(name="fk_Pokemon_has_Spread_Spread1_idx", columns={"Spread_idspread"}), @ORM\Index(name="fk_Pokemon_has_Spread_Pokemon1_idx", columns={"Pokemon_Idpoke"})})
 * @ORM\Entity(repositoryClass="App\Repository\PokemonTieneSpreadRepository")
 */
class PokemonTieneSpread
{
    /**
     * @var float
     *
     * @ORM\Column(name="Porcentaje_uso", type="float", precision=10, scale=0, nullable=false)
     */
    private $porcentajeUso;

    /**
     * @var \Formato
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Formato")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Formato_Id", referencedColumnName="Id")
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

    /**
     * @var \Spread
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Spread")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Spread_idspread", referencedColumnName="Idspread")
     * })
     */
    private $spreadIdspread;

    public function getPorcentajeUso(): ?float
    {
        return $this->porcentajeUso;
    }

    public function setPorcentajeUso(float $porcentajeUso): self
    {
        $this->porcentajeUso = $porcentajeUso;

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

    public function getSpreadIdspread(): ?Spread
    {
        return $this->spreadIdspread;
    }

    public function setSpreadIdspread(?Spread $spreadIdspread): self
    {
        $this->spreadIdspread = $spreadIdspread;

        return $this;
    }


}
