<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campeonato
 *
 * @ORM\Table(name="campeonato", indexes={@ORM\Index(name="fk_Campeonato_Formato1_idx", columns={"Formato_Id"})})
 * @ORM\Entity
 */
class Campeonato
{
    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=45, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="Categoria", type="string", length=45, nullable=false)
     */
    private $categoria;

    /**
     * @var \Formato
     *
     * @ORM\ManyToOne(targetEntity="Formato")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Formato_Id", referencedColumnName="Id")
     * })
     */
    private $formato;

    public function getNombre(): ?string
    {
        return $this->nombre;
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


}
