<?php
namespace App\Controllers;

use App\Library\Json;
use App\Models\CartProduct;
use App\Repository\CartProductRepository;

class CartProductController
{
    private CartProductRepository $cartProductRepository;

    public function __construct(CartProductRepository $cartProductRepository)
    {
        $this->cartProductRepository = $cartProductRepository;
    }

    public function index()
    {
        $cartProducts = $this->cartProductRepository->getAll();
        Json::render($cartProducts, 200);
    }

    public function show($id)
    {
        $cartProduct = $this->cartProductRepository->getById($id);
        Json::render($cartProduct->toArray(), 200);
    }

    public function create()
    {
        $json = file_get_contents('php://input');
        $cartProductReceived = json_decode($json);
        $cartProduct = new CartProduct();
        $cartProduct->fill($cartProductReceived);

        $this->cartProductRepository->create($cartProduct);

        Json::render([
            'message' => 'Cart product created',
        ], 201);
    }

    public function update($id)
    {
        $cartProduct = $this->cartProductRepository->getById($id);
        $json = file_get_contents('php://input');
        $cartProductReceived = json_decode($json);
        $cartProduct->fill($cartProductReceived);

        $this->cartProductRepository->update($cartProduct);

        Json::render([
            'message' => 'Cart product updated',
        ], 200);
    }

    public function delete($id)
    {
        $cartProduct = $this->cartProductRepository->getById($id);
        
        $this->cartProductRepository->delete($cartProduct);

        Json::render([
            'message' => 'Cart product deleted',
        ], 200);
    }
}