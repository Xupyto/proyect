<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Articulo
 *
 * @ORM\Table(name="articulo")
 * @ORM\Entity
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
     *
     * @ORM\Column(name="Titulo", type="string", length=60, nullable=false)
     */
    private $titulo;

    /**
     * @var string
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


}
