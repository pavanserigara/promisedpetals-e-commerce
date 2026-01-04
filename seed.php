<?php
// seed.php - Seed database with sample products for JSON Database

require_once 'app/config/config.php';
require_once 'app/core/Database.php';

$db = new Database();

echo "Seeding Products...\n";

// Clear existing products to avoid duplicates from initDb
$existingProducts = $db->findAll('products');
foreach ($existingProducts as $p) {
    // Ideally we would delete them, but Database::delete is by ID.
    // For a clean seed, we can just rely on the user having deleted db.json or this script being run on a fresh DB.
    // But since initDb adds some, let's just proceed. The IDs will auto-increment.
}
// Actually, if we want a CLEAN state matching the seed list exactly, we might want to truncate the products table.
// But the JSON DB structure is simple. Let's just create a new list.
// We cannot easily 'truncate' via the public API without iterating delete.
// Let's iterate and delete all existing products first if we want a clean slate (optional).
// Or simpler: The user deletes db.json, initDb creates 3 products. We add 8 more.
// Let's just add them.

$products = [
    // Roses
    [
        'category_id' => 2,
        'name' => 'Classic Red Roses',
        'slug' => 'classic-red-roses',
        'description' => 'A timeless bouquet of 12 premium red roses, hand-tied with gypsophila and eucalyptus.',
        'price' => 59.99,
        'stock' => 50,
        'image' => 'red_roses.jpg',
        'is_featured' => 1,
        'is_bestseller' => 1
    ],
    [
        'category_id' => 2,
        'name' => 'Pink Paradise',
        'slug' => 'pink-paradise',
        'description' => 'Soft pink roses arranged with white lilies and lush greenery.',
        'price' => 64.99,
        'stock' => 40,
        'image' => 'pink_roses.jpg',
        'is_featured' => 0,
        'is_bestseller' => 1
    ],

    // Bouquets
    [
        'category_id' => 1,
        'name' => 'Spring Whisper',
        'slug' => 'spring-whisper',
        'description' => 'A vibrant mix of tulips, daffodils, and irises to celebrate the season.',
        'price' => 45.00,
        'stock' => 30,
        'image' => 'spring_bouquet.jpg',
        'is_featured' => 1,
        'is_bestseller' => 0
    ],
    [
        'category_id' => 1,
        'name' => 'Ocean Breeze',
        'slug' => 'ocean-breeze',
        'description' => 'Blue hydrangeas and white delphiniums reminding you of the sea.',
        'price' => 55.00,
        'stock' => 25,
        'image' => 'ocean_bouquet.jpg',
        'is_featured' => 0,
        'is_bestseller' => 0
    ],

    // Wedding
    [
        'category_id' => 3,
        'name' => 'White Elegance',
        'slug' => 'white-elegance',
        'description' => 'Pristine white roses and orchids perfect for your special day.',
        'price' => 89.99,
        'stock' => 20,
        'image' => 'wedding_white.jpg',
        'is_featured' => 1,
        'is_bestseller' => 0
    ],
    [
        'category_id' => 3,
        'name' => 'Rustic Romance',
        'slug' => 'rustic-romance',
        'description' => 'Wildflowers and roses in a rustic arrangement.',
        'price' => 75.00,
        'stock' => 15,
        'image' => 'wedding_rustic.jpg',
        'is_featured' => 0,
        'is_bestseller' => 0
    ],

    // Gifts
    [
        'category_id' => 4,
        'name' => 'Birthday Bloom Box',
        'slug' => 'birthday-bloom-box',
        'description' => 'Colorful gerberas and roses in a luxury gift box.',
        'price' => 49.99,
        'stock' => 45,
        'image' => 'box_colorful.jpg',
        'is_featured' => 0,
        'is_bestseller' => 1
    ],
    [
        'category_id' => 4,
        'name' => 'Thinking of You',
        'slug' => 'thinking-of-you',
        'description' => 'A gentle arrangement of carnations and chrysanthemums.',
        'price' => 39.99,
        'stock' => 60,
        'image' => 'carnations.jpg',
        'is_featured' => 0,
        'is_bestseller' => 0
    ]
];

foreach ($products as $p) {
    try {
        // Here we just insert. We don't check for duplicates in this simple script 
        // because Database::insert doesn't enforce uniqueness on non-ID fields unless we check manually.
        // For a seed script, checking slug uniqueness is good practice.

        $existing = $db->findOne('products', ['slug' => $p['slug']]);
        if ($existing) {
            echo "Skipping existing product: {$p['name']}\n";
            continue;
        }

        $id = $db->insert('products', $p);
        echo "Inserted: {$p['name']} (ID: $id)\n";

    } catch (Exception $e) {
        echo "Error inserting {$p['name']}: " . $e->getMessage() . "\n";
    }
}

echo "Done.\n";
