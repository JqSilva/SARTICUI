<?php
namespace App\Controllers;

use App\Models\BodegaModel;

class BodegaController extends BaseController
{
    public function index()
    {
        $model = new BodegaModel();
        $data['insumos'] = $model->obtenerInsumosEnBodega();

        // Renderiza la vista con el layout dinámico según el rol (ya lo maneja BaseController)
        return $this->renderView('modules/bodega/index', $data);
    }
}