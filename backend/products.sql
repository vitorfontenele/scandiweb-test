CREATE TABLE `products` (
  `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(250) NOT NULL,
  `price` FLOAT(10,2) NOT NULL,
  `sku` VARCHAR(100) UNIQUE NOT NULL,
  `type` VARCHAR(100) NOT NULL,
  `size` INT(10),
  `weight` FLOAT(10,2),
  `height` FLOAT(10,2),
  `width` FLOAT(10,2),
  `length` FLOAT(10,2),
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
)
