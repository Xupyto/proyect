<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Campeonato
 *
 * @ORM\Table(name="campeonato", indexes={@ORM\Index(name="fk_campeonato_formato1_idx", columns={"formato_Id"})})
 * @ORM\Entity
 * @UniqueEntity(fields={"nombre"}, message="Ya hay un objeto que se llama así.")
 */
class Campeonato
{
    /**
     * @var int
     *
     * @ORM\Column(name="Idcampeonato", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcampeonato;

    /**
     * @var string
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @Assert\Length(min=2,max=45,minMessage="Longitud mínima 2 caracteres",maxMessage="Longitud máxima 45 carácteres")
     * @Assert\Regex(
     *      pattern="/^[ÁÉÍÓÚA-Z]+/",
     *      message="El valor no puede ser un valor numérico/no emmpieza por mayúscula."
     * )
     * @ORM\Column(name="Nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @Assert\Length(min=2,max=45,minMessage="Longitud mínima 2 caracteres",maxMessage="Longitud máxima 45 carácteres")
     * @Assert\Regex(
     *      pattern="/(JUNIORS)|(MASTERS)|(SENIORS)/",
     *      message="El valor no puede ser un valor numérico/no emmpieza por mayúscula."
     * )
     * @ORM\Column(name="Categoria", type="string", length=45, nullable=false)
     */
    private $categoria;

    /**
     * @var \Formato
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @ORM\ManyToOne(targetEntity="Formato")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="formato_Id", referencedColumnName="Id")
     * })
     */
    private $formato;

    public function getIdcampeonato(): ?int
    {
        return $this->idcampeonato;
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

    public function getCategoria(): ?string
    {
        return $this->categoria;
    }

    public function setCategoria(string $categoria): self
    {
        $this->categoria = $categoria;

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

    public function __toString()
    {
        return $this->nombre;
    }

}
