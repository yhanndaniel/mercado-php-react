<?php
namespace App\Controllers;

use App\Library\Json;
use App\Models\Product;
use App\Repository\ProductRepository;

class ProductController
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->getAll();
        // var_dump($products);
        // die();
        Json::render($products, 200);
    }

    public function show($id)
    {
        $product = $this->productRepository->getById($id);
        Json::render($product->toArray(), 200);
    }

    public function create()
    {
        $json = file_get_contents('php://input');
        $productReceived = json_decode($json);
        $product = new Product();
        $product->fill($productReceived);

        $this->productRepository->create($product);

        Json::render([
            'message' => 'Product created',
        ], 201);
    }

    public function update($id)
    {
        $product = $this->productRepository->getById($id);
        $json = file_get_contents('php://input');
        $productReceived = json_decode($json);
        $product->fill($productReceived);

        $this->productRepository->update($product);

        Json::render([
            'message' => 'Product updated',
        ], 200);
    }

    public function delete($id)
    {
        $product = $this->productRepository->getById($id);

        $this->productRepository->delete($product);

        Json::render([
            'message' => 'Product deleted',
        ], 200);
    }
}
