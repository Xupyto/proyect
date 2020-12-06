<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Equipo
 *
 * @ORM\Table(name="equipo", indexes={@ORM\Index(name="fk_equipo_usuario1_idx", columns={"usuario_email"})})
 * @ORM\Entity(repositoryClass="App\Repository\EquipoRepository")
 * @UniqueEntity(fields={"nombre"}, message="Ya hay un equipo que se llama así.")
 */
class Equipo
{
    /**
     * @var int
     *
     * @ORM\Column(name="idequipo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idequipo;

    /**
     * @var string
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @ORM\Column(name="Nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var \Usuario
     *
     *
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_email", referencedColumnName="email")
     * })
     */
    private $usuarioEmail;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     *@ORM\OneToMany(targetEntity="EquipoContienePokemon", mappedBy="equipoIdequipo", cascade={"all"})
     */
    private $pokemonIdpoke;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pokemonIdpoke = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return Collection|Pokemon[]
     */
    public function getPokes(): Collection
    {
        return $this->pokemonIdpoke;
    }

    public function addPoke(Pokemon $poke): self
    {
        if (!$this->pokemonIdpoke->contains($poke)) {
            $this->pokemonIdpoke[] = $poke;
            $poke->addEquipo($this);
        }

        return $this;
    }

    public function removePoke(Pokemon $poke): self
    {
        if ($this->pokemonIdpoke->contains($poke)) {
            $this->pokemonIdpoke->removeElement($poke);
            $poke->removeEquipo($this);
        }

        return $this;
    }

    public function getidequipo(): ?int
    {
        return $this->idequipo;
    }

    public function setidequipo(int $id): self
    {
        $this->idequipo = $id;

        return $this;
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
    public function getUsuarioemail(): ?Usuario
    {
        return $this->usuarioEmail;
    }

    public function setUsuarioemail(Usuario $email): self
    {
        $this->usuarioEmail = $email;

        return $this;
    }

}
