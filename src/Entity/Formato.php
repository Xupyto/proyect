<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formato
 *
 * @ORM\Table(name="formato", uniqueConstraints={@ORM\UniqueConstraint(name="Nombre_UNIQUE", columns={"Nombre"})})
 * @ORM\Entity(repositoryClass="App\Repository\FormatoRepository")
 */
class Formato
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=20, nullable=false)
     */
    private $nombre;


    /**
    *  Bidirectional - uno a muchos (INVERSE SIDE) Para poner atributos extras en una relación N-M
    *
    * @ORM\OneToMany(targetEntity="PokemonEstaEnFormato", mappedBy="formato", cascade={"all"})
    *
    */
    private $formatotienepokes; 

    public function getFormatoTienepokes(): ?PokemonEstaEnFormato
    {
        return $this->formatotienepokes;
    }

    public function setPoketieneformat(PokemonEstaEnFormato $pokeisformat): self
    {
        $this->formatotienepokes = $pokeisformat;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function __toString()
    {
        return $this->nombre;
    }

    

}
