<?php
/**
 * Helper to get product image path with fallback
 */
function getProductImage($image)
{
    $placeholder = 'placeholder.jpg';
    $path = APPROOT . '/../public/img/products/';

    if (!empty($image) && file_exists($path . $image)) {
        return URLROOT . '/img/products/' . $image;
    }

    return URLROOT . '/img/products/' . $placeholder;
}

/**
 * Helper to get category image path with fallback
 */
function getCategoryImage($image)
{
    $placeholder = 'placeholder.jpg'; // or specific category placeholder
    $path = APPROOT . '/../public/img/categories/';

    if (!empty($image) && file_exists($path . $image)) {
        return URLROOT . '/img/categories/' . $image;
    }

    return URLROOT . '/img/products/' . $placeholder; // Fallback to general placeholder
}
