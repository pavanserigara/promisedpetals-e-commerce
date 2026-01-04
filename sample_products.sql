-- Sample Products for Promised Petals

INSERT INTO `products` (`category_id`, `name`, `slug`, `description`, `price`, `stock`, `image`, `is_featured`, `is_bestseller`) VALUES
-- Roses
(2, 'Classic Red Roses', 'classic-red-roses', 'A timeless bouquet of 12 premium red roses, hand-tied with gypsophila and eucalyptus.', 59.99, 50, 'red_roses.jpg', 1, 1),
(2, 'Pink Paradise', 'pink-paradise', 'Soft pink roses arranged with white lilies and lush greenery.', 64.99, 40, 'pink_roses.jpg', 0, 1),

-- Bouquets
(1, 'Spring Whisper', 'spring-whisper', 'A vibrant mix of tulips, daffodils, and irises to celebrate the season.', 45.00, 30, 'spring_bouquet.jpg', 1, 0),
(1, 'Ocean Breeze', 'ocean-breeze', 'Blue hydrangeas and white delphiniums reminding you of the sea.', 55.00, 25, 'ocean_bouquet.jpg', 0, 0),

-- Wedding
(3, 'White Elegance', 'white-elegance', 'Pristine white roses and orchids perfect for your special day.', 89.99, 20, 'wedding_white.jpg', 1, 0),
(3, 'Rustic Romance', 'rustic-romance', 'Wildflowers and roses in a rustic arrangement.', 75.00, 15, 'wedding_rustic.jpg', 0, 0),

-- Gifts
(4, 'Birthday Bloom Box', 'birthday-bloom-box', 'Colorful gerberas and roses in a luxury gift box.', 49.99, 45, 'box_colorful.jpg', 0, 1),
(4, 'Thinking of You', 'thinking-of-you', 'A gentle arrangement of carnations and chrysanthemums.', 39.99, 60, 'carnations.jpg', 0, 0);
