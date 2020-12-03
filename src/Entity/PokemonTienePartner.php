<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * PokemonTienePartner
 *
 * @ORM\Table(name="pokemon_tiene_partner", indexes={@ORM\Index(name="fk_Pokemon_has_Pokemon_Pokemon1_idx", columns={"Pokemon_Idpoke"}), @ORM\Index(name="fk_Pokemon_tiene_partner_Formato1_idx", columns={"Formato_Id"}), @ORM\Index(name="fk_Pokemon_has_Pokemon_Pokemon2_idx", columns={"Pokemon_Idpoke1"})})
 * @ORM\Entity(repositoryClass="App\Repository\PokemonTienePartnerRepository")
 * @UniqueEntity(fields={"formato","pokemonIdpoke","pokemonIdpoke1"}, message="Ya existe ese registro.")
 */
class PokemonTienePartner
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
     * @var \Pokemon
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Pokemon")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Pokemon_Idpoke1", referencedColumnName="Idpoke")
     * })
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     */
    private $pokemonIdpoke1;

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

    public function getPorcentajeUso(): ?float
    {
        return $this->porcentajeUso;
    }

    public function setPorcentajeUso(float $porcentajeUso): self
    {
        $this->porcentajeUso = $porcentajeUso;

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

    public function getPokemonIdpoke1(): ?Pokemon
    {
        return $this->pokemonIdpoke1;
    }

    public function setPokemonIdpoke1(?Pokemon $pokemonIdpoke1): self
    {
        $this->pokemonIdpoke1 = $pokemonIdpoke1;

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


}
