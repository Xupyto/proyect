<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * PokeUsaObj
 *
 * @ORM\Table(name="poke_usa_obj", indexes={@ORM\Index(name="fk_Pokemon_has_Objeto_Formato1_idx", columns={"Formato_id"}), @ORM\Index(name="fk_Pokemon_has_Objeto_Objeto1_idx", columns={"Objeto_idobjeto"}), @ORM\Index(name="fk_Pokemon_has_Objeto_Pokemon1_idx", columns={"Pokemon_Idpoke"})})
 * @ORM\Entity(repositoryClass="App\Repository\Pokemon_usaobjRepository")
 * @UniqueEntity(fields={"formato","pokemonIdpoke","objetoIdobjeto"}, message="Ya existe ese registro.")
 */
class PokeUsaObj
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
     *   @ORM\JoinColumn(name="Formato_id", referencedColumnName="Id")
     * })
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     */
    private $formato;

    /**
     * @var \Objeto
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Objeto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Objeto_idobjeto", referencedColumnName="Idobjeto")
     * })
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     */
    private $objetoIdobjeto;

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

    public function getObjetoIdobjeto(): ?Objeto
    {
        return $this->objetoIdobjeto;
    }

    public function setObjetoIdobjeto(?Objeto $objetoIdobjeto): self
    {
        $this->objetoIdobjeto = $objetoIdobjeto;

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
