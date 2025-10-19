<?php
namespace App\Controllers;
use App\Models\BodegaModel;
use CodeIgniter\Controller;

// Controlador de Stock

class StockController extends Controller
{
    public function index()
    {
        $model = new BodegaModel();
        $data['insumos'] = $model->obtenerInsumosEnBodega();
        return view('stock', $data);
    }
}
