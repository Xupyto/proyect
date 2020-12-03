<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Articulo
 *
 * @ORM\Table(name="articulo")
 * @ORM\Entity(repositoryClass="App\Repository\ArticuloRepository")
 * @UniqueEntity(fields={"titulo"}, message="Ya hay una noticia que se llama así.")
 */
class Articulo
{
    /**
     * @var int
     *
     * @ORM\Column(name="idarticulo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idarticulo;

    /**
     * @var string
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @Assert\Length(min=2,max=40,minMessage="Longitud mínima 2 caracteres",maxMessage="Longitud máxima 40 carácteres")
     * @Assert\Regex(
     *      pattern="/^[ÁÉÍÓÚA-Z]+/",
     *      message="El valor no puede ser un valor numérico/no emmpieza por mayúscula."
     * )
     * @ORM\Column(name="Titulo", type="string", length=60, nullable=false)
     */
    private $titulo;

    /**
     * @var string
     * @Assert\NotBlank(message="Este campo no puede dejarse vacío.")
     * @Assert\Length(min=10,max=65535,minMessage="Longitud mínima 10 caracteres",maxMessage="Longitud máxima 65535 carácteres")
     * 
     * @ORM\Column(name="Contenido", type="text", length=65535, nullable=false)
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\Column(name="Foto", type="string", length=45, nullable=false)
     */
    private $foto;

    public function getIdarticulo(): ?int
    {
        return $this->idarticulo;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getContenido(): ?string
    {
        return $this->contenido;
    }

    public function setContenido(string $contenido): self
    {
        $this->contenido = $contenido;

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

    public function __toString()
    {
        return $this->titulo;
    }


}
