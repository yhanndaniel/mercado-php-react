<?php
namespace App\Controllers;

use App\Library\Json;
use App\Models\ProductType;
use App\Repository\ProductTypeRepository;

class ProductTypeController
{

    private ProductTypeRepository $productTypeRepository;
    public function __construct(ProductTypeRepository $productTypeRepository)
    {
        $this->productTypeRepository = $productTypeRepository;
    }
    public function index()
    {
        $productTypes = $this->productTypeRepository->getAll();
        Json::render($productTypes, 200);
    }

    public function show($id)
    {
        $productType = $this->productTypeRepository->getById($id);
        Json::render($productType->toArray(), 200);
    }

    public function create()
    {
        $json = file_get_contents('php://input');
        $productTypeReceived = json_decode($json);
        $productType = new ProductType();
        $productType->fill($productTypeReceived);

        $this->productTypeRepository->create($productType);

        Json::render([
            'message' => 'Product Type created',
        ], 201);
    }

    public function update($id)
    {
        $productType = $this->productTypeRepository->getById($id);
        $json = file_get_contents('php://input');
        $productTypeReceived = json_decode($json);
        $productType->fill($productTypeReceived);

        $this->productTypeRepository->update($productType);

        Json::render([
            'message' => 'Product Type updated',
        ], 200);
    }

    public function delete($id)
    {
        $productType = $this->productTypeRepository->getById($id);
        $this->productTypeRepository->delete($productType);

        Json::render([
            'message' => 'Product Type deleted',
        ], 200);
    }
}