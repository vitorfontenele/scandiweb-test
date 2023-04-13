<?php

use App\Core\Database;

class DvdDatabase extends Database {
    public function create(Dvd $product) : ?Dvd {
        $query = 'INSERT INTO products (name, price, sku, type, size)
            VALUES (:name, :price, :sku, :type, :size)';
        
        $stmt = $this->getConn()->prepare($query);

        $stmt->bindValue(':name', $product->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':price', $product->getPrice(), PDO::PARAM_STR);
        $stmt->bindValue(':sku', $product->getSku(), PDO::PARAM_STR);
        $stmt->bindValue(':type', $product->getType(), PDO::PARAM_STR);
        $stmt->bindValue(':size', $product->getSize(), PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $product;
          }
        return null;
    }
}