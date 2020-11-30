<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Formato
 *
 * @ORM\Table(name="formato", uniqueConstraints={@ORM\UniqueConstraint(name="Nombre_UNIQUE", columns={"Nombre"})})
 * @ORM\Entity(repositoryClass="App\Repository\FormatoRepository")
 * @UniqueEntity(fields={"nombre"}, message="Ya hay un formato que se llama así.")
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
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @Assert\Length(min=2,max=20,minMessage="Longitud mínima 2 caracteres",maxMessage="Longitud máxima 20 carácteres")
     * @Assert\Regex(
     *      pattern="/^[ÁÉÍÓÚA-Z]+/",
     *      message="El valor no puede ser un valor numérico/no emmpieza por mayúscula."
     * )
     * @ORM\Column(name="Nombre", type="string", length=20, nullable=false)
     */
    private $nombre;


    /**
    *  Bidirectional - uno a muchos (INVERSE SIDE) Para poner atributos extras en una relación N-M
    *
    * @ORM\OneToMany(targetEntity="PokemonEstaEnFormato", mappedBy="formato", cascade={"all"})
    *
    */
    private $formathaspoke;

     /**
     * Constructor
     */
    public function __construct()
    {
        $this->formathaspoke = new \Doctrine\Common\Collections\ArrayCollection();
    }

   /**
     * @return Collection|Pokemon[]
     */
    public function getformathaspoke(): Collection
    {
        return $this->formathaspoke;
    }

    public function addformathaspoke(Pokemon $formathaspoke): self
    {
        if (!$this->formathaspoke->contains($formathaspoke)) {
            $this->formathaspoke[] = $formathaspoke;
            $formathaspoke->addFormat($this);
        }

        return $this;
    }

    public function removeformathaspoke(Pokemon $formathaspoke): self
    {
        if ($this->formathaspoke->contains($formathaspoke)) {
            $this->formathaspoke->removeElement($formathaspoke);
            $formathaspoke->removeFormat($this);
        }

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
