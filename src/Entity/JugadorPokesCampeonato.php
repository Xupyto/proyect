<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * JugadorPokesCampeonato
 *
 * @ORM\Table(name="jugador_pokes_campeonato", indexes={@ORM\Index(name="fk_jugador_has_campeonato_jugador1_idx", columns={"jugador_Idjugador"}), @ORM\Index(name="fk_jugador_has_campeonato_campeonato1_idx", columns={"campeonato_Idcampeonato"}), @ORM\Index(name="fk_jugador_has_campeonato_pokemon1_idx", columns={"pokemon_Idpoke"})})
 * @ORM\Entity(repositoryClass="App\Repository\JugadorPokeCampeonatoRepository")
 * @UniqueEntity(fields={"campeonatoIdcampeonato","jugadorIdjugador","pokemonIdpoke"}, message="Ya existe ese registro.")
 */
class JugadorPokesCampeonato
{
    /**
     * @var \Movimiento
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @ORM\ManyToOne(targetEntity="Movimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Mov1", referencedColumnName="Id_mov")
     * })
     */
    private $mov1;

    /**
     * @var \Movimiento
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @ORM\ManyToOne(targetEntity="Movimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Mov2", referencedColumnName="Id_mov")
     * })
     */
    private $mov2;

    /**
     * @var \Movimiento
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @ORM\ManyToOne(targetEntity="Movimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Mov3", referencedColumnName="Id_mov")
     * })
     */
    private $mov3;

    /**
     * @var \Movimiento
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @ORM\ManyToOne(targetEntity="Movimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Mov4", referencedColumnName="Id_mov")
     * })
     */
    private $mov4;

    /**
     * @var \Objeto
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @ORM\ManyToOne(targetEntity="Objeto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Objeto", referencedColumnName="Idobjeto")
     * })
     */
    private $objeto;

    /**
     * @var \Habilidad
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * 
     * @ORM\ManyToOne(targetEntity="Habilidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Habilidad", referencedColumnName="Idhabilidad")
     * })
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
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
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
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
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
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     */
    private $pokemonIdpoke;

    public function getMov1(): ?Movimiento
    {
        return $this->mov1;
    }

    public function setMov1(Movimiento $mov1): self
    {
        $this->mov1 = $mov1;

        return $this;
    }

    public function getMov2(): ?Movimiento
    {
        return $this->mov2;
    }

    public function setMov2(Movimiento $mov2): self
    {
        $this->mov2 = $mov2;

        return $this;
    }

    public function getMov3(): ?Movimiento
    {
        return $this->mov3;
    }

    public function setMov3(Movimiento $mov3): self
    {
        $this->mov3 = $mov3;

        return $this;
    }

    public function getMov4(): ?Movimiento
    {
        return $this->mov4;
    }

    public function setMov4(Movimiento $mov4): self
    {
        $this->mov4 = $mov4;

        return $this;
    }

    public function getObjeto(): ?Objeto
    {
        return $this->objeto;
    }

    public function setObjeto(Objeto $objeto): self
    {
        $this->objeto = $objeto;

        return $this;
    }

    public function getHabilidad(): ?Habilidad
    {
        return $this->habilidad;
    }

    public function setHabilidad(Habilidad $habilidad): self
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
