<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JugadorPokesCampeonato
 *
 * @ORM\Table(name="jugador_pokes_campeonato", indexes={@ORM\Index(name="fk_jugador_has_campeonato_jugador1_idx", columns={"jugador_Idjugador"}), @ORM\Index(name="fk_jugador_has_campeonato_pokemon1_idx", columns={"pokemon_Idpoke"}), @ORM\Index(name="fk_jugador_has_campeonato_campeonato1_idx", columns={"campeonato_Idcampeonato"})})
 * @ORM\Entity
 */
class JugadorPokesCampeonato
{
    /**
     * @var int
     *
     * @ORM\Column(name="Mov1", type="integer", nullable=false)
     */
    private $mov1;

    /**
     * @var int
     *
     * @ORM\Column(name="Mov2", type="integer", nullable=false)
     */
    private $mov2;

    /**
     * @var int
     *
     * @ORM\Column(name="Mov3", type="integer", nullable=false)
     */
    private $mov3;

    /**
     * @var int
     *
     * @ORM\Column(name="Mov4", type="integer", nullable=false)
     */
    private $mov4;

    /**
     * @var int
     *
     * @ORM\Column(name="Objeto", type="integer", nullable=false)
     */
    private $objeto;

    /**
     * @var int
     *
     * @ORM\Column(name="Habilidad", type="integer", nullable=false)
     */
    private $habilidad;

    /**
     * @var \Campeonato
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Campeonato")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="campeonato_Idcampeonato", referencedColumnName="Idcampeonato")
     * })
     */
    private $campeonatoIdcampeonato;

    /**
     * @var \Jugador
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Jugador")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="jugador_Idjugador", referencedColumnName="Idjugador")
     * })
     */
    private $jugadorIdjugador;

    /**
     * @var \Pokemon
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Pokemon")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pokemon_Idpoke", referencedColumnName="Idpoke")
     * })
     */
    private $pokemonIdpoke;

    public function getMov1(): ?int
    {
        return $this->mov1;
    }

    public function setMov1(int $mov1): self
    {
        $this->mov1 = $mov1;

        return $this;
    }

    public function getMov2(): ?int
    {
        return $this->mov2;
    }

    public function setMov2(int $mov2): self
    {
        $this->mov2 = $mov2;

        return $this;
    }

    public function getMov3(): ?int
    {
        return $this->mov3;
    }

    public function setMov3(int $mov3): self
    {
        $this->mov3 = $mov3;

        return $this;
    }

    public function getMov4(): ?int
    {
        return $this->mov4;
    }

    public function setMov4(int $mov4): self
    {
        $this->mov4 = $mov4;

        return $this;
    }

    public function getObjeto(): ?int
    {
        return $this->objeto;
    }

    public function setObjeto(int $objeto): self
    {
        $this->objeto = $objeto;

        return $this;
    }

    public function getHabilidad(): ?int
    {
        return $this->habilidad;
    }

    public function setHabilidad(int $habilidad): self
    {
        $this->habilidad = $habilidad;

        return $this;
    }

    public function getCampeonatoIdcampeonato(): ?Campeonato
    {
        return $this->campeonatoIdcampeonato;
    }

    public function setCampeonatoIdcampeonato(?Campeonato $campeonatoIdcampeonato): self
    {
        $this->campeonatoIdcampeonato = $campeonatoIdcampeonato;

        return $this;
    }

    public function getJugadorIdjugador(): ?Jugador
    {
        return $this->jugadorIdjugador;
    }

    public function setJugadorIdjugador(?Jugador $jugadorIdjugador): self
    {
        $this->jugadorIdjugador = $jugadorIdjugador;

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
