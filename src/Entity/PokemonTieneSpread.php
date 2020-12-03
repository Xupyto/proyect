<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * PokemonTieneSpread
 *
 * @ORM\Table(name="pokemon_tiene_spread", indexes={@ORM\Index(name="fk_Pokemon_has_Spread_Formato1_idx", columns={"Formato_Id"}), @ORM\Index(name="fk_Pokemon_has_Spread_Spread1_idx", columns={"Spread_idspread"}), @ORM\Index(name="fk_Pokemon_has_Spread_Pokemon1_idx", columns={"Pokemon_Idpoke"})})
 * @ORM\Entity(repositoryClass="App\Repository\PokemonTieneSpreadRepository")
 * @UniqueEntity(fields={"formato","pokemonIdpoke","spreadIdspread"}, message="Ya existe ese registro.")
 */
class PokemonTieneSpread
{
    /**
     * @var float
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @Assert\Range(
     *      min = 0.001,
     *      max = 100,
     *      minMessage = "Debes ser al menos {{ limit }} para ser válido.",
     *      maxMessage = "No puedes introducir un valor mayo a {{ limit }}. "
     * )
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
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
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
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
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
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
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
