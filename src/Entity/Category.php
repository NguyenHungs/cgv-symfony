<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    public function __construct()
    {
        $this->createdAt= new \DateTime();
        $this->updatedAt= new \DateTime();
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
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="category_id")
     */
    private $product;

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

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

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

}
