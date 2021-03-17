<?php


namespace App\ViewModel;


class ProductViewModel
{
    private $id;

    private $categoryId;

    private $name;

    private $price;

    private $descriptionBg;

    private $descriptionEn;

    private $imageUrl;

    private $tags;

    private $imageGallery;

    private $categoryNameEn;

    private $categoryNameBg;

    public function setGallery(?array $gallery): void
    {
        $this->imageGallery = [$this->imageUrl];
        if ($gallery == null || count($gallery) < 1) {
            return;
        }

        $this->imageGallery = array_merge($this->imageGallery, $gallery);
    }

    public function setCategoryNameBg($categoryNameBg): void
    {
        $this->categoryNameBg = $categoryNameBg;
    }

    public function setCategoryNameEn($categoryNameEn): void
    {
        $this->categoryNameEn = $categoryNameEn;
    }
}