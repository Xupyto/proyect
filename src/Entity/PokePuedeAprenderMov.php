<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * PokePuedeAprenderMov
 *
 * @ORM\Table(name="poke_puede_aprender_mov", indexes={@ORM\Index(name="fk_Pokemon_has_Formato_Pokemon1_idx", columns={"Pokemon_Idpoke"}), @ORM\Index(name="fk_Pokemon_has_Formato_Formato1_idx", columns={"Formato_Id"}), @ORM\Index(name="fk_Pokemon_has_Formato_Movimiento1_idx", columns={"Movimiento_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\Pokemon_aprende_movRepository")
 * @UniqueEntity(fields={"formato","pokemonIdpoke","movimiento"}, message="Ya existe ese registro.")
 */
class PokePuedeAprenderMov
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
     * @Assert\IsTrue()
     */
    private $formato;

    /**
     * @var \Movimiento
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Movimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Movimiento_id", referencedColumnName="Id_mov")
     * })
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     */
    private $movimiento;

    /**
     * @var \Pokemon
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Pokemon")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Pokemon_Idpoke", referencedColumnName="Idpoke")
     * })
     * @Assert\IsTrue()
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

    public function getMovimiento(): ?Movimiento
    {
        return $this->movimiento;
    }

    public function setMovimiento(?Movimiento $movimiento): self
    {
        $this->movimiento = $movimiento;

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
        return $this->formato;
    }


}
