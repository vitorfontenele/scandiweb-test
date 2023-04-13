<?php

use App\Core\Controller;
use App\Core\ResponseHandler;
use App\Validators\ProductValidator;
use App\Databases\ProductDatabase;

  class ProductController extends Controller {
    private $productDatabase;
    private $productValidator;

    public function __construct()
    {
      $this->productDatabase = new ProductDatabase();
      $this->productValidator = new ProductValidator();
    }
    
    public function index() {
      try {
        $products = $this->productDatabase->findAll();

        if (!$products) {
          ResponseHandler::respondWithSuccess(null, null, 204);
        }

        $productsOutput =$this->transformProducts($products);
        ResponseHandler::respondWithSuccess(null, $productsOutput);

      } catch (Exception $e){
        ResponseHandler::respondWithError($e->getMessage(), 500);
      }
    }

    private function transformProducts(array $products): array {
      $productsOutput = array();

      foreach ($products as $product){
          $type = $product["type"];
          $modelByType = $this->model($type);
          $modelByType->setAttributes((object) $product);
          $modelByType->setSpecialAttributes((object) $product);
          $productToAppend = [
              ...(array) $modelByType->getAttributes(),
              "specialAttributes" => $modelByType->getSpecialAttributes()
          ];
          $productsOutput[] = $productToAppend;
      }

      return $productsOutput;
  }

    public function store() {
      try {
        $body = $this->getRequestBody();

        $this->productValidator->validateAttributes($body);

        $skuExists = $this->productDatabase->findBySku($body->sku);
        if ($skuExists) {
          ResponseHandler::respondWithError("SKU already exists", 400);
        }

        $validatorByType = $this->productValidator->validator($body->type);
        $validatorByType->validateSpecialAttributes($body);

        $modelByType = $this->model($body->type);
        
        $modelByType->setAttributes($body);
        $modelByType->setSpecialAttributes($body);

        $databaseByType = $this->productDatabase->database($body->type);
        $newEntry = $databaseByType->create($modelByType);
      
        if ($newEntry) {
          ResponseHandler::respondWithSuccess(null, $body, 201);
        };
        
      } catch (Exception $e){
        ResponseHandler::respondWithError($e->getMessage(), 500);
      } 
    }

    public function delete($sku) {
      try {
        $productExists = $this->productDatabase->findBySku($sku);

        if (!$productExists) {
          ResponseHandler::respondWithError("Product not found", 404);
        }

        $this->productDatabase->deleteBySku($sku);
        ResponseHandler::respondWithSuccess("Product deleted", null);

      } catch (Exception $e) {
        ResponseHandler::respondWithError($e->getMessage(), 500);
      }
    }

    public function deleteMany() {
      try {
        $body = $this->getRequestBody();
        $skus = $body->skus ?? null;

        if (!isset($skus)) {
          ResponseHandler::respondWithError("No sku informed", 400);
        }

        foreach($skus as $sku) {
          $checkProduct = $this->productDatabase->findBySku($sku);
          if ($checkProduct) {
            $this->productDatabase->deleteBySku($sku);
          }
        }

        ResponseHandler::respondWithSuccess("Products deleted", null);
        
      } catch (Exception $e){
        ResponseHandler::respondWithError($e->getMessage(), 500);
      }
    }
  }