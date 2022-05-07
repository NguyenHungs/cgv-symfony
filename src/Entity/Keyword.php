<?php

namespace App\Entity;

use App\Repository\KeywordRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KeywordRepository::class)
 */
class Keyword
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, inversedBy="keyword_id")
     */
    private $keyword_id;

    public function __construct()
    {
        $this->keyword_id = new ArrayCollection();
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

    /**
     * @return Collection<int, Product>
     */
    public function getKeywordId(): Collection
    {
        return $this->keyword_id;
    }

    public function addKeywordId(Product $keywordId): self
    {
        if (!$this->keyword_id->contains($keywordId)) {
            $this->keyword_id[] = $keywordId;
        }

        return $this;
    }

    public function removeKeywordId(Product $keywordId): self
    {
        $this->keyword_id->removeElement($keywordId);

        return $this;
    }
}
