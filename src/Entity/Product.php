<?php


namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * Product
 *
 * @ORM\Table(name="products")
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column (name="category_id", type="integer")
     */
    private $categoryId;

    /**
     * @var ProductCategory
     * @ORM\ManyToOne(targetEntity="App\Entity\ProductCategory")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @var string
     * @ORM\Column(name="product_name", type="string", length=40)
     */
    private $name;

    /**
     * @var double|null
     * @ORM\Column(name="price", type="float", nullable=true)
     */
    private $price;

    /**
     * @var string|null
     * @ORM\Column(name="description_bg", type="text", nullable=true)
     */
    private $descriptionBg;

    /**
     * @var string|null
     * @ORM\Column(name="description_en", type="text", nullable=true)
     */
    private $descriptionEn;

    /**
     * @var string
     * @ORM\Column(name="image_url", type="string", length=255)
     */
    private $imageUrl;

    /**
     * @var string[]|null
     * @ORM\Column(name="tags", type="array", nullable=true)
     */
    private $tags;

    /**
     * @var bool
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @var Image[]
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="product", fetch="LAZY")
     */
    private $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function getCategory(): ProductCategory
    {
        return $this->category;
    }

    public function setCategory(ProductCategory $category): void
    {
        $this->category = $category;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    public function getDescriptionBg(): ?string
    {
        return $this->descriptionBg;
    }

    public function setDescriptionBg(?string $descriptionBg): void
    {
        $this->descriptionBg = $descriptionBg;
    }

    public function getDescriptionEn(): ?string
    {
        return $this->descriptionEn;
    }

    public function setDescriptionEn(?string $descriptionEn): void
    {
        $this->descriptionEn = $descriptionEn;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    public function getTags(): ?array
    {
        return $this->tags;
    }

    public function setTags(?array $tags): void
    {
        $this->tags = $tags;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function getImages(): Collection
    {
        return $this->images;
    }

    public function setImages($images): void
    {
        $this->images = $images;
    }
}