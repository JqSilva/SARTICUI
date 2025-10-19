<?php
namespace App\Controllers;
use App\Models\BodegaModel;
use CodeIgniter\Controller;

// Controlador de Bodega

class BodegaController extends Controller
{
    public function index()
    {
        $model = new BodegaModel();
        $data['insumos'] = $model->obtenerInsumosEnBodega();
        return view('bodega', $data);
    }
}
