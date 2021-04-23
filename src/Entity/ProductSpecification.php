<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductSpecification
 *
 * @ORM\Table(name="product_specifications")
 * @ORM\Entity(repositoryClass="App\Repository\ProductSpecificationRepository")
 */
class ProductSpecification
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
     * @ORM\Column (name="product_id", type="integer")
     */
    private $productId;

    /**
     * @var Product
     * @ORM\ManyToOne(targetEntity="App\Entity\Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    /**
     * @var string|null
     * @ORM\Column(name="title_bg", type="string", length=255, nullable=true)
     */
    private $titleBg;

    /**
     * @var string|null
     * @ORM\Column(name="title_en", type="string", length=255, nullable=true)
     */
    private $titleEn;

    /**
     * @var string|null
     * @ORM\Column(name="value_bg", type="string", length=255, nullable=true)
     */
    private $valueBg;

    /**
     * @var string|null
     * @ORM\Column(name="value_en", type="string", length=255, nullable=true)
     */
    private $valueEn;

    public function __construct()
    {

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public function getTitleBg(): ?string
    {
        return $this->titleBg;
    }

    public function setTitleBg(?string $titleBg): void
    {
        $this->titleBg = $titleBg;
    }

    public function getTitleEn(): ?string
    {
        return $this->titleEn;
    }

    public function setTitleEn(?string $titleEn): void
    {
        $this->titleEn = $titleEn;
    }

    public function getValueBg(): ?string
    {
        return $this->valueBg;
    }

    public function setValueBg(?string $valueBg): void
    {
        $this->valueBg = $valueBg;
    }

    public function getValueEn(): ?string
    {
        return $this->valueEn;
    }

    public function setValueEn(?string $valueEn): void
    {
        $this->valueEn = $valueEn;
    }
}

