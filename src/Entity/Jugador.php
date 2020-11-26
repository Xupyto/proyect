<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jugador
 *
 * @ORM\Table(name="jugador")
 * @ORM\Entity
 */
class Jugador
{
    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=30, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nombre;

    public function getNombre(): ?string
    {
        return $this->nombre;
    }


}
