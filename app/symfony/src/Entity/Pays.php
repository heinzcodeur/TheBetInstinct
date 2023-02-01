<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;


/**
 * @ORM\Entity(repositoryClass=PaysRepository::class)
 * @ApiResource(
 *     attributes={"pagination_items_per_page"=2}
 *     )
 * @ApiFilter(SearchFilter::class,properties={"name":"partial"})
 */
class Pays
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:ville"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $shortcut;

    /**
     * @ORM\OneToMany(targetEntity=Villes::class, mappedBy="pays")
     */
    private $villes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $capitale;

    public function __construct()
    {
        $this->villes = new ArrayCollection();
    }

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

    public function getShortcut(): ?string
    {
        return $this->shortcut;
    }

    public function setShortcut(?string $shortcut): self
    {
        $this->shortcut = $shortcut;

        return $this;
    }

    /**
     * @return Collection<int, Villes>
     */
    public function getVilles(): Collection
    {
        return $this->villes;
    }

    public function addVille(Villes $ville): self
    {
        if (!$this->villes->contains($ville)) {
            $this->villes[] = $ville;
            $ville->setPays($this);
        }

        return $this;
    }

    public function removeVille(Villes $ville): self
    {
        if ($this->villes->removeElement($ville)) {
            // set the owning side to null (unless already changed)
            if ($ville->getPays() === $this) {
                $ville->setPays(null);
            }
        }

        return $this;
    }

    public function getCapitale(): ?string
    {
        return $this->capitale;
    }

    public function setCapitale(?string $capitale): self
    {
        $this->capitale = $capitale;

        return $this;
    }
}
