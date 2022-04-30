<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    public function __construct()
    {
        $this->createdAt= new \DateTime();
        $this->updatedAt= new \DateTime();
        $this->category_id = new ArrayCollection();
        $this->user_id = new ArrayCollection();
        $this->keywords = new ArrayCollection();
    }
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
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=Category::class, mappedBy="id")
     */
    private $category_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $view;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sale;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pay;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="id")
     */
    private $user_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $favourite;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $comment;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $review_total;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $review_star;

     /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetimetz")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetimetz")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Keyword::class, mappedBy="name")
     */
    private $keywords;
 

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategoryId(): Collection
    {
        return $this->category_id;
    }

    public function addCategoryId(Category $categoryId): self
    {
        if (!$this->category_id->contains($categoryId)) {
            $this->category_id[] = $categoryId;
            $categoryId->setId($this);
        }

        return $this;
    }

    public function removeCategoryId(category $categoryId): self
    {
        if ($this->category_id->removeElement($categoryId)) {
            // set the owning side to null (unless already changed)
            if ($categoryId->getId() === $this) {
                $categoryId->setId(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getView(): ?int
    {
        return $this->view;
    }

    public function setView(int $view): self
    {
        $this->view = $view;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getSale(): ?string
    {
        return $this->sale;
    }

    public function setSale(?string $sale): self
    {
        $this->sale = $sale;

        return $this;
    }

    public function getPay(): ?int
    {
        return $this->pay;
    }

    public function setPay(?int $pay): self
    {
        $this->pay = $pay;

        return $this;
    }

    /**
     * @return Collection<int, user>
     */
    public function getUserId(): Collection
    {
        return $this->user_id;
    }

    public function addUserId(user $userId): self
    {
        if (!$this->user_id->contains($userId)) {
            $this->user_id[] = $userId;
            $userId->setId($this);
        }

        return $this;
    }

    public function removeUserId(user $userId): self
    {
        if ($this->user_id->removeElement($userId)) {
            // set the owning side to null (unless already changed)
            if ($userId->getId() === $this) {
                $userId->setId(null);
            }
        }

        return $this;
    }

    public function getFavourite(): ?int
    {
        return $this->favourite;
    }

    public function setFavourite(?int $favourite): self
    {
        $this->favourite = $favourite;

        return $this;
    }

    public function getComment(): ?int
    {
        return $this->comment;
    }

    public function setComment(?int $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getReviewTotal(): ?int
    {
        return $this->review_total;
    }

    public function setReviewTotal(?int $review_total): self
    {
        $this->review_total = $review_total;

        return $this;
    }

    public function getReviewStar(): ?int
    {
        return $this->review_star;
    }

    public function setReviewStar(?int $review_star): self
    {
        $this->review_star = $review_star;

        return $this;
    }

    
     /**
         * Set createdAt.
         *
         * @param \DateTime $createdAt
         *
         * @return Order
         */
        public function setCreateAt($createdAt)
        {
            $this->created_at = $createdAt;

            return $this;
        }

        /**
         * Get createdAt.
         *
         * @return \DateTime
         */
        public function getCreateAt()
        {
            return $this->created_at;
        }

        /**
         * Set updatedAt.
         *
         * @param \DateTime $updatedAt
         *
         * @return Category
         */
        public function setUpdatedAt($updatedAt)
        {
            $this->updated_at = $updatedAt;

            return $this;
        }

        /**
         * Get updatedAt.
         *
         * @return \DateTime
         */
        public function getUpdatedAt()
        {
            return $this->updated_at;
        }

        /**
         * @return Collection<int, Keyword>
         */
        public function getKeywords(): Collection
        {
            return $this->keywords;
        }

        public function addKeyword(Keyword $keyword): self
        {
            if (!$this->keywords->contains($keyword)) {
                $this->keywords[] = $keyword;
                $keyword->addName($this);
            }

            return $this;
        }

        public function removeKeyword(Keyword $keyword): self
        {
            if ($this->keywords->removeElement($keyword)) {
                $keyword->removeName($this);
            }

            return $this;
        }

}
