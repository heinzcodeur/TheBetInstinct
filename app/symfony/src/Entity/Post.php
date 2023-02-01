<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"read:collection"}},
 *     collectionOperations={
 *                          "get",
 *                          "post"={"validation_groups"={"create:post"}}
 *                          },
 *     itemOperations={"get"={"normalizationContext":{"groups"={"read:collection","read:item","read:Post"}}},
 *                     "put"={"denormalizationContext":{"groups"={"write:post"}}}
 *                  }
 * )
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:collection"})
     */
    private $id;

    /**
     * @Assert\NotBlank(
     *     message="il faut remplir ce champ",
     *     groups={"create:post"}
     *  )
     * @Assert\Length(
     *     min = 9,
     *     max = 33,
     *     groups={"create:post"}
     * )
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:collection","write:post"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:collection"})
     */
    private $slug;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"read:item"})
     */
    private $content;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"read:item"})
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="posts")
     * @Groups({"read:item","write:post"})
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
