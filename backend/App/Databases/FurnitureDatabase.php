<?php

use App\Core\Database;

class FurnitureDatabase extends Database {
    public function create(Furniture $product) : ?Furniture {
        $query = 'INSERT INTO products (name, price, sku, type, length, height, width)
        VALUES (:name, :price, :sku, :type, :length, :height, :width)';

        $stmt = $this->getConn()->prepare($query);

        $stmt->bindValue(':name', $product->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':price', $product->getPrice(), PDO::PARAM_STR);
        $stmt->bindValue(':sku', $product->getSku(), PDO::PARAM_STR);
        $stmt->bindValue(':type', $product->getType(), PDO::PARAM_STR);
        $stmt->bindValue(':length', $product->getLength(), PDO::PARAM_STR);
        $stmt->bindValue(':height', $product->getHeight(), PDO::PARAM_STR);
        $stmt->bindValue(':width', $product->getWidth(), PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $product;
        }
        return null;    
    }
}