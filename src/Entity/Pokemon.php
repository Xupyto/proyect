<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Pokemon
 *
 * @ORM\Table(name="pokemon")
 * @ORM\Entity(repositoryClass="App\Repository\PokemonRepository")
 */
class Pokemon
{
    /**
     * @var int
     *
     * @ORM\Column(name="Idpoke", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     */
    private $idpoke;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @Assert\Length(min=2,max=45,minMessage="Longitud mínima 5 caracteres",maxMessage="Longitud máxima 45 carácteres")
     * @Assert\Regex(
     *      pattern="/^[ÁÉÍÓÚA-Z]+/",
     *      message="El valor no puede ser un valor numérico/no emmpieza por mayúscula."
     * )
     * 
     */
    private $nombre;

    /**
     * @var int
     *
     * @ORM\Column(name="Hp", type="integer", nullable=false)
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @Assert\Type(
     *     type="integer",
     *     message="El valor {{ value }} no es del tipo {{ type }}."
     * )
     *  @Assert\Positive(message="El precio debe ser un valor positivo")
     */
    private $hp;

    /**
     * @var int
     *
     * @ORM\Column(name="Atq", type="integer", nullable=false)
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @Assert\Type(
     *     type="integer",
     *     message="El valor {{ value }} no es del tipo {{ type }}."
     * )
     *  @Assert\Positive(message="El precio debe ser un valor positivo")
     */
    private $atq;

    /**
     * @var int
     *
     * @ORM\Column(name="Def", type="integer", nullable=false)
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @Assert\Type(
     *     type="integer",
     *     message="El valor {{ value }} no es del tipo {{ type }}."
     * )
     *  @Assert\Positive(message="El precio debe ser un valor positivo")
     */
    private $def;

    /**
     * @var int
     *
     * @ORM\Column(name="Spa", type="integer", nullable=false)
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @Assert\Type(
     *     type="integer",
     *     message="El valor {{ value }} no es del tipo {{ type }}."
     * )
     *  @Assert\Positive(message="El precio debe ser un valor positivo")
     */
    private $spa;

    /**
     * @var int
     *
     * @ORM\Column(name="Spd", type="integer", nullable=false)
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @Assert\Type(
     *     type="integer",
     *     message="El valor {{ value }} no es del tipo {{ type }}."
     * )
     *  @Assert\Positive(message="El precio debe ser un valor positivo")
     */
    private $spd;

    /**
     * @var int
     *
     * @ORM\Column(name="Vel", type="integer", nullable=false)
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @Assert\Type(
     *     type="integer",
     *     message="El valor {{ value }} no es del tipo {{ type }}."
     * )
     *  @Assert\Positive(message="El precio debe ser un valor positivo")
     */
    private $vel;

    /**
     * @var string
     *
     * @ORM\Column(name="Foto", type="string", length=255, nullable=false)
     * 
     */
    private $foto;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @Assert\Count(max=2)
     *
     * @ORM\ManyToMany(targetEntity="Tipo", inversedBy="pokemonIdpoke")
     * @ORM\JoinTable(name="pokemon_tiene_tipo",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Pokemon_Idpoke", referencedColumnName="Idpoke")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Tipo_Nombre", referencedColumnName="Nombre")
     *   }
     * )
     */
    private $tipoNombre;

    /**
    *  Bidirectional - uno a muchos (INVERSE SIDE) Para poner atributos extras en una relación N-M
    *
    * @ORM\OneToMany(targetEntity="PokemonEstaEnFormato", mappedBy="pokemonIdpoke", cascade={"all"})
    *
    */
    private $poketieneformat;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tipoNombre = new \Doctrine\Common\Collections\ArrayCollection();
        $this->poketieneformat = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdpoke(): ?int
    {
        return $this->idpoke;
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

    public function getHp(): ?int
    {
        return $this->hp;
    }

    public function setHp(int $hp): self
    {
        $this->hp = $hp;

        return $this;
    }

    public function getAtq(): ?int
    {
        return $this->atq;
    }

    public function setAtq(int $atq): self
    {
        $this->atq = $atq;

        return $this;
    }

    public function getDef(): ?int
    {
        return $this->def;
    }

    public function setDef(int $def): self
    {
        $this->def = $def;

        return $this;
    }

    public function getSpa(): ?int
    {
        return $this->spa;
    }

    public function setSpa(int $spa): self
    {
        $this->spa = $spa;

        return $this;
    }

    public function getSpd(): ?int
    {
        return $this->spd;
    }

    public function setSpd(int $spd): self
    {
        $this->spd = $spd;

        return $this;
    }

    public function getVel(): ?int
    {
        return $this->vel;
    }

    public function setVel(int $vel): self
    {
        $this->vel = $vel;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * @return Collection|Tipo[]
     */
    public function getTipoNombre(): Collection
    {
        return $this->tipoNombre;
    }

    public function addTipoNombre(Tipo $tipoNombre): self
    {
        if (!$this->tipoNombre->contains($tipoNombre)) {
            $this->tipoNombre[] = $tipoNombre;
        }

        return $this;
    }

    public function removeTipoNombre(Tipo $tipoNombre): self
    {
        if ($this->tipoNombre->contains($tipoNombre)) {
            $this->tipoNombre->removeElement($tipoNombre);
        }

        return $this;
    }

    public function removeTipos(): self
    {
        unset($this->tipoNombre);
        $this->tipoNombre = new \Doctrine\Common\Collections\ArrayCollection();
        return $this;
    }

    /**
     * @return Collection|Tipo[]
     */
    public function getFormats(): Collection
    {
        return $this->poketieneformat;
    }

    public function addFormat(Formato $format): self
    {
        if (!$this->poketieneformat->contains($format)) {
            $this->poketieneformat[] = $format;
        }

        return $this;
    }

    public function removeFormat(Formato $format): self
    {
        if ($this->poketieneformat->contains($format)) {
            $this->poketieneformat->removeElement($format);
        }

        return $this;
    }
    
    public function __toString()
    {
        return $this->nombre;
    }

    
}
