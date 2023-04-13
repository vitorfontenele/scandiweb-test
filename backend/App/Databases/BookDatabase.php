<?php

use App\Core\Database;

class BookDatabase extends Database {
    public function create(Book $product) : ?Book {
        $query = 'INSERT INTO products (name, price, sku, type, weight)
          VALUES (:name, :price, :sku, :type, :weight)';
      
        $stmt = $this->getConn()->prepare($query);
      
        $stmt->bindValue(':name', $product->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':price', $product->getPrice(), PDO::PARAM_STR);
        $stmt->bindValue(':sku', $product->getSku(), PDO::PARAM_STR);
        $stmt->bindValue(':type', $product->getType(), PDO::PARAM_STR);
        $stmt->bindValue(':weight', $product->getWeight(), PDO::PARAM_STR);
      
        if ($stmt->execute()) {
          return $product;
        }
        return null;
      }
}