<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * EquipoContienePokemon
 *
 * @ORM\Table(name="equipo_tiene_pokemon", indexes={@ORM\Index(name="fk_Usuario_has_Pokemon_Equipo1_idx", columns={"Equipo_idequipo", "Equipo_Usuario_email"}), @ORM\Index(name="fk_Usuario_has_Pokemon_Pokemon1_idx", columns={"Pokemon_Idpoke"})})
 * @ORM\Entity
 */
class EquipoContienePokemon
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Pokemon", inversedBy="pokeestaenequipos")
     * @ORM\JoinColumn(name="Pokemon_Idpoke", referencedColumnName="Idpoke",
     * columnDefinition="bigint COMMENT 'Un pokemon puede tener muchos equipos'", nullable=false, onDelete="CASCADE")
     */
    private $pokemonIdpoke;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Equipo", inversedBy="pokemonIdpoke")
     * @ORM\JoinColumn(name="equipo_idequipo", referencedColumnName="idequipo",
     * columnDefinition="bigint COMMENT 'Un equipo tiene 6 pokemon máximo'", nullable=false, onDelete="CASCADE")
     */
    private $equipoIdequipo;

   
    /**
     * @var string|null
     *
     * @ORM\Column(name="Mov1", type="string", length=45, nullable=true)
     */
    private $mov1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Mov2", type="string", length=45, nullable=true)
     */
    private $mov2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Mov3", type="string", length=45, nullable=true)
     */
    private $mov3;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Mov4", type="string", length=45, nullable=true)
     */
    private $mov4;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Objeto", type="string", length=45, nullable=true)
     */
    private $objeto;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Habilidad", type="string", length=45, nullable=true)
     */
    private $habilidad;

  

    /**
     * @var string|null
     *
     * @ORM\Column(name="Spread", type="string", length=45, nullable=true)
     */
    private $spread;

    public function getPokemonIdpoke(): ?int
    {
        return $this->pokemonIdpoke;
    }

    public function getEquipoIdequipo(): ?int
    {
        return $this->equipoIdequipo;
    }

    public function getEquipoUsuarioEmail(): ?string
    {
        return $this->equipoUsuarioEmail;
    }

    public function getMov1(): ?string
    {
        return $this->mov1;
    }

    public function setMov1(?string $mov1): self
    {
        $this->mov1 = $mov1;

        return $this;
    }

    public function getMov2(): ?string
    {
        return $this->mov2;
    }

    public function setMov2(?string $mov2): self
    {
        $this->mov2 = $mov2;

        return $this;
    }

    public function getMov3(): ?string
    {
        return $this->mov3;
    }

    public function setMov3(?string $mov3): self
    {
        $this->mov3 = $mov3;

        return $this;
    }

    public function getMov4(): ?string
    {
        return $this->mov4;
    }

    public function setMov4(?string $mov4): self
    {
        $this->mov4 = $mov4;

        return $this;
    }

    public function getObjeto(): ?string
    {
        return $this->objeto;
    }

    public function setObjeto(?string $objeto): self
    {
        $this->objeto = $objeto;

        return $this;
    }

    public function getHabilidad(): ?string
    {
        return $this->habilidad;
    }

    public function setHabilidad(?string $habilidad): self
    {
        $this->habilidad = $habilidad;

        return $this;
    }

   

    public function getSpread(): ?string
    {
        return $this->spread;
    }

    public function setSpread(?string $spread): self
    {
        $this->spread = $spread;

        return $this;
    }

    public function __toString()
    {
            return $this->getPokemonIdpoke() . $this->getEquipoIdequipo();
        
    }


}
