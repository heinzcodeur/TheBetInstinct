<?php

namespace App\Entity;

use App\Repository\VillesRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=VillesRepository::class)
 * @ApiResource(
 *     itemOperations={
 *     "get"={"normalizationContext":{"groups"={"read:collection","read:ville","read:post"}}},
 *     "put"={"denormalizationContext":{"groups"={"write:ville"}}}
 *     }
 * )
 */
class Villes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:collection"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:collection","write:ville"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="villes")
     * @Groups({"read:ville"})
     */
    private $pays;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }
}
