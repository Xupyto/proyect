<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * PokeTieneHabilidad
 *
 * @ORM\Table(name="poke_tiene_habilidad", indexes={@ORM\Index(name="fk_Habilidad_has_Pokemon_Habilidad1_idx", columns={"Habilidad_Id"}), @ORM\Index(name="fk_Habilidad_has_Pokemon_Pokemon1_idx", columns={"Pokemon_Idpoke"}), @ORM\Index(name="fk_Habilidad_has_Pokemon_Formato1_idx", columns={"Formato_Id"})})
 * @ORM\Entity(repositoryClass="App\Repository\PokeTieneHabilidadRepository")
 * @UniqueEntity(fields={"formato","pokemonIdpoke","habilidad"}, message="Ya existe ese registro.")
 */
class PokeTieneHabilidad
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
     * @var \Habilidad
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Habilidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Habilidad_Id", referencedColumnName="Idhabilidad")
     * })
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     */
    private $habilidad;

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

    public function getHabilidad(): ?Habilidad
    {
        return $this->habilidad;
    }

    public function setHabilidad(?Habilidad $habilidad): self
    {
        $this->habilidad = $habilidad;

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
