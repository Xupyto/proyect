<?php

namespace App\Entity;


use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Spread
 *
 * @ORM\Table(name="spread", uniqueConstraints={@ORM\UniqueConstraint(name="Stats_UNIQUE", columns={"Stats"})})
 * @ORM\Entity
 */
class Spread
{
    /**
     * @var int
     *
     * @ORM\Column(name="Idspread", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idspread;

    /**
     * @var string
     * @Assert\Regex(pattern="/^[A-Z][a-z]+ \d{1,3}\/\d{1,3}\/\d{1,3}\/\d{1,3}\/\d{1,3}\/\d{1,3}/")
     * @ORM\Column(name="Stats", type="string", length=100, nullable=false)
     */
    private $stats;

    public function getIdspread(): ?int
    {
        return $this->idspread;
    }

    public function getStats(): ?string
    {
        return $this->stats;
    }

    public function setStats(string $stats): self
    {
        $this->stats = $stats;

        return $this;
    }


}
