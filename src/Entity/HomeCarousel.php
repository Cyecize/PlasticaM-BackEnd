<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HomeCarousel
 *
 * @ORM\Table(name="home_carousel")
 * @ORM\Entity(repositoryClass="App\Repository\HomeCarouselRepository")
 */
class HomeCarousel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int|null
     * @ORM\Column(name="product_id", type="integer", nullable=true)
     */
    private $productId;

    /**
     * @var string|null
     * @ORM\Column(name="text_en", type="string", nullable=true, length=255)
     */
    private $textEn;

    /**
     * @var string|null
     * @ORM\Column(name="text_bg", type="string", nullable=true, length=255)
     */
    private $textBg;

    /**
     * @var string
     * @ORM\Column(name="image_url", type="string", length=255)
     */
    private $imageUrl;

    /**
     * @var string|null
     * @ORM\Column(name="custom_link", type="string", length=255, nullable=true)
     */
    private $customLink;

    /**
     * @var boolean|null
     * @ORM\Column(name="custom_link_same_page", type="boolean", nullable=true)
     */
    private $customLinkSamePage;

    /**
     * @var boolean
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    private $enabled;

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

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(?int $productId): void
    {
        $this->productId = $productId;
    }

    public function getTextEn(): ?string
    {
        return $this->textEn;
    }

    public function setTextEn(?string $textEn): void
    {
        $this->textEn = $textEn;
    }

    public function getTextBg(): ?string
    {
        return $this->textBg;
    }

    public function setTextBg(?string $textBg): void
    {
        $this->textBg = $textBg;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    public function getCustomLink(): ?string
    {
        return $this->customLink;
    }

    public function setCustomLink(?string $customLink): void
    {
        $this->customLink = $customLink;
    }

    public function getCustomLinkSamePage(): ?bool
    {
        return $this->customLinkSamePage;
    }

    public function setCustomLinkSamePage(?bool $customLinkSamePage): void
    {
        $this->customLinkSamePage = $customLinkSamePage;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }
}