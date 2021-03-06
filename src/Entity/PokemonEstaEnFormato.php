<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * PokemonEstaEnFormato
 *
 * @ORM\Table(name="pokemon_esta_en_formato", indexes={@ORM\Index(name="fk_Formato_has_Pokemon_Formato1_idx", columns={"Formato_id"}), @ORM\Index(name="fk_Formato_has_Pokemon_Pokemon1_idx", columns={"Pokemon_Idpoke"})})
 * @ORM\Entity(repositoryClass="App\Repository\Pokemon_esta_en_formatoRepository")
 * @UniqueEntity(fields={"formato","pokemonIdpoke"}, message="Ya existe ese registro.")
 * 
 */
class PokemonEstaEnFormato
{
    /**
     * @var float
     *
     * @ORM\Column(name="Porcentaje_uso", type="float", precision=10, scale=0, nullable=false)
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @Assert\Range(
     *      min = 0.001,
     *      max = 100,
     *      minMessage = "Debes ser al menos {{ limit }} para ser válido.",
     *      maxMessage = "No puedes introducir un valor mayo a {{ limit }}. "
     * )
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $porcentajeUso;

    /**
     * Bidirectional - muchos a uno (OWNING SIDE)
     *
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Formato", inversedBy="formathaspoke")
     * @ORM\JoinColumn(name="Formato_Id", referencedColumnName="Id",
     * columnDefinition="bigint COMMENT 'En un formato hay muchos pokes'", nullable=false, onDelete="CASCADE")
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     */
    private $formato;

    /**
     * Bidirectional - muchos a uno (OWNING SIDE)
     *
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Pokemon", inversedBy="poketieneformat")
     * @ORM\JoinColumn(name="Pokemon_Idpoke", referencedColumnName="Idpoke",
     * columnDefinition="bigint COMMENT 'Un pokemon tiene muchos formatos'", nullable=false, onDelete="CASCADE")
     *
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

    
    public function __toString()
    {
            return $this->getFormato()->getNombre();
        
    }


}
