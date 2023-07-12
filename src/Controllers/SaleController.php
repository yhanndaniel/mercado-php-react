<?php
namespace App\Controllers;

use App\Library\Json;
use App\Models\Sale;
use App\Repository\SaleRepository;

class SaleController
{
    private SaleRepository $saleRepository;

    public function __construct(SaleRepository $saleRepository)
    {
        $this->saleRepository = $saleRepository;
    }

    public function index()
    {
        $sales = $this->saleRepository->getAll();
        Json::render($sales, 200);
    }

    public function show($id)
    {
        $sale = $this->saleRepository->getById($id);
        Json::render($sale->toArray(), 200);
    }

    public function create()
    {
        $json = file_get_contents('php://input');
        $saleReceived = json_decode($json);
        $sale = new Sale();
        $sale->fill($saleReceived);

        $id = $this->saleRepository->create($sale);

        Json::render([
            'message' => 'Sale created',
            'id' => $id
        ], 201);
    }

    public function update($id)
    {
        $sale = $this->saleRepository->getById($id);
        $json = file_get_contents('php://input');
        $saleReceived = json_decode($json);
        $sale->fill($saleReceived);

        $this->saleRepository->update($sale);

        Json::render([
            'message' => 'Sale updated',
        ], 200);
    }

    public function delete($id)
    {
        $sale = $this->saleRepository->getById($id);

        $this->saleRepository->delete($sale);

        Json::render([
            'message' => 'Sale deleted',
        ], 200);
    }
}
