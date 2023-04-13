<?php

namespace App\Databases;
use App\Core\Database;

class ProductDatabase extends Database {
    public function findAll() : ?array {
        $query = 'SELECT * FROM products';
  
        $stmt = $this->getConn()->prepare($query);
        $stmt->execute();
  
        if ($stmt->rowCount() > 0) {
          $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
          return $result;
        } else {
          return null;
        }
    }

    public function findBySku(string $sku) : ?array {
        $query = 'SELECT * FROM products WHERE sku = :sku';
  
        $stmt = $this->getConn()->prepare($query);
        $stmt->bindValue(':sku', $sku, \PDO::PARAM_STR);
        $stmt->execute();
  
        if ($stmt->rowCount() > 0) {
          return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
          return null;
        }
    }

    public function findById(string $id) : ?array {
      $query = 'SELECT * FROM products WHERE id = :id';

      $stmt = $this->getConn()->prepare($query);
      $stmt->bindValue(':id', $id, \PDO::PARAM_STR);
      $stmt->execute();

      if ($stmt->rowCount() > 0) {
        return $stmt->fetch(\PDO::FETCH_ASSOC);
      } else {
        return null;
      }
    }
    
    public function deleteBySku(string $sku) : void {
      $query = 'DELETE FROM products WHERE sku = :sku';
      $stmt = $this->getConn()->prepare($query);
      $stmt->bindValue(':sku', $sku, \PDO::PARAM_STR);
      $stmt->execute();
    }
}