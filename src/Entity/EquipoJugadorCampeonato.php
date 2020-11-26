<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EquipoJugadorCampeonato
 *
 * @ORM\Table(name="equipo_jugador_campeonato", indexes={@ORM\Index(name="fk_Jugador_has_Campeonato_Jugador1_idx", columns={"Jugador_Nombre"}), @ORM\Index(name="fk_Jugador_has_Campeonato_Campeonato1_idx", columns={"Campeonato_Nombre"}), @ORM\Index(name="fk_Jugador_has_Campeonato_Pokemon1_idx", columns={"Pokemon_Idpoke"})})
 * @ORM\Entity
 */
class EquipoJugadorCampeonato
{
    /**
     * @var string
     *
     * @ORM\Column(name="Mov1", type="string", length=45, nullable=false)
     */
    private $mov1;

    /**
     * @var string
     *
     * @ORM\Column(name="Mov2", type="string", length=45, nullable=false)
     */
    private $mov2;

    /**
     * @var string
     *
     * @ORM\Column(name="Mov3", type="string", length=45, nullable=false)
     */
    private $mov3;

    /**
     * @var string
     *
     * @ORM\Column(name="Mov4", type="string", length=45, nullable=false)
     */
    private $mov4;

    /**
     * @var string
     *
     * @ORM\Column(name="Objeto", type="string", length=45, nullable=false)
     */
    private $objeto;

    /**
     * @var string
     *
     * @ORM\Column(name="Habilidad", type="string", length=45, nullable=false)
     */
    private $habilidad;

    /**
     * @var string
     *
     * @ORM\Column(name="Naturaleza", type="string", length=45, nullable=false)
     */
    private $naturaleza;

    /**
     * @var \Campeonato
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Campeonato")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Campeonato_Nombre", referencedColumnName="Nombre")
     * })
     */
    private $campeonatoNombre;

    /**
     * @var \Jugador
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Jugador")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Jugador_Nombre", referencedColumnName="Nombre")
     * })
     */
    private $jugadorNombre;

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

    public function getMov1(): ?string
    {
        return $this->mov1;
    }

    public function setMov1(string $mov1): self
    {
        $this->mov1 = $mov1;

        return $this;
    }

    public function getMov2(): ?string
    {
        return $this->mov2;
    }

    public function setMov2(string $mov2): self
    {
        $this->mov2 = $mov2;

        return $this;
    }

    public function getMov3(): ?string
    {
        return $this->mov3;
    }

    public function setMov3(string $mov3): self
    {
        $this->mov3 = $mov3;

        return $this;
    }

    public function getMov4(): ?string
    {
        return $this->mov4;
    }

    public function setMov4(string $mov4): self
    {
        $this->mov4 = $mov4;

        return $this;
    }

    public function getObjeto(): ?string
    {
        return $this->objeto;
    }

    public function setObjeto(string $objeto): self
    {
        $this->objeto = $objeto;

        return $this;
    }

    public function getHabilidad(): ?string
    {
        return $this->habilidad;
    }

    public function setHabilidad(string $habilidad): self
    {
        $this->habilidad = $habilidad;

        return $this;
    }

    public function getNaturaleza(): ?string
    {
        return $this->naturaleza;
    }

    public function setNaturaleza(string $naturaleza): self
    {
        $this->naturaleza = $naturaleza;

        return $this;
    }

    public function getCampeonatoNombre(): ?Campeonato
    {
        return $this->campeonatoNombre;
    }

    public function setCampeonatoNombre(?Campeonato $campeonatoNombre): self
    {
        $this->campeonatoNombre = $campeonatoNombre;

        return $this;
    }

    public function getJugadorNombre(): ?Jugador
    {
        return $this->jugadorNombre;
    }

    public function setJugadorNombre(?Jugador $jugadorNombre): self
    {
        $this->jugadorNombre = $jugadorNombre;

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
