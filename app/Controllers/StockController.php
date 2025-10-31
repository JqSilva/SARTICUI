<?php
namespace App\Controllers;

use App\Models\BodegaModel;

class StockController extends BaseController
{
    public function index()
    {
        $model = new BodegaModel();
        $data['insumos'] = $model->obtenerInsumosEnBodega();

        // renderView() viene del BaseController
        return $this->renderView('modules/stock/index', $data);
    }
}