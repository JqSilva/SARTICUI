<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\InsumoModel;
use App\Models\DisponibilidadModel;
use App\Models\ClasificacionModel;

// Controlador de Insumo

class InsumoController extends ResourceController
{
    protected $modelName = 'App\Models\InsumoModel';
    protected $format = 'json';

    // GET /insumos - Obtener todos los insumos
    public function index()
    {
        // Obtener todos los insumos
        $insumos = $this->model->findAll();

        // Obtener las clasificaciones y disponibilidades
        $clasificacionModel = new ClasificacionModel();
        $disponibilidadModel = new DisponibilidadModel();
        $clasificaciones = $clasificacionModel->findAll();
        $disponibilidades = $disponibilidadModel->findAll();

        // Convertir estado_insumo a texto
        foreach ($insumos as &$insumo) {
            $insumo['ESTADO_INSUMO'] = $insumo['ESTADO_INSUMO'] == 1 ? 'Activa' : 'Inactiva';

            // Obtener nombres de clasificación y disponibilidad
            foreach ($clasificaciones as $clasificacion) {
                if ($insumo['ID_CLASIFICACION_INSUMO'] == $clasificacion['ID_CLASIFICACION']) {
                    $insumo['CLASIFICACION_NOMBRE'] = $clasificacion['NOMBRE_CLASIFICACION'];
                    break;
                }
            }

            foreach ($disponibilidades as $disponibilidad) {
                if ($insumo['ID_DISPONIBILIDAD_INSUMO'] == $disponibilidad['ID_DISPONIBILIDAD']) {
                    $insumo['DISPONIBILIDAD_NOMBRE'] = $disponibilidad['NOMBRE_DISPONIBILIDAD'];
                    break;
                }
            }
        }

        // Pasar los datos a la vista
        return view('insumos/index', [
            'insumos' => $insumos,
            'clasificaciones' => $clasificaciones,
            'disponibilidades' => $disponibilidades
        ]);
    }

    // GET /insumos/create - Mostrar el formulario para crear un insumo
    public function create()
    {
        // Obtener datos de las tablas clasificacion y disponibilidad
        $clasificacionModel = new ClasificacionModel();
        $disponibilidadModel = new DisponibilidadModel();

        $clasificaciones = $clasificacionModel->findAll();
        $disponibilidades = $disponibilidadModel->findAll();

        // Pasar los datos a la vista
        return view('insumos/create', [
            'clasificaciones' => $clasificaciones,
            'disponibilidades' => $disponibilidades
        ]);
    }

    // POST /insumos - Crear un nuevo insumo
    public function store()
    {
        $data = $this->request->getPost();

        if ($this->model->insert($data)) {
            return redirect()->to(base_url('/insumos'))->with('message', 'Insumo creado exitosamente');
        }
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    // GET /insumos/edit/{id} - Mostrar el formulario para editar un insumo
    public function edit($id = null)
    {
        $insumo = $this->model->find($id);

        if ($insumo) {
            // Obtener datos de las tablas Clasificacion y Disponibilidad
            $clasificacionModel = new ClasificacionModel();
            $disponibilidadModel = new DisponibilidadModel();

            $clasificaciones = $clasificacionModel->findAll();
            $disponibilidades = $disponibilidadModel->findAll();

            // Pasar los datos a la vista
            return view('insumos/edit', [
                'insumo' => $insumo,
                'clasificaciones' => $clasificaciones,
                'disponibilidades' => $disponibilidades
            ]);
        }
        return redirect()->to('/insumos')->with('error', 'No se encontró el insumo con ID: ' . $id);
    }

    // POST /insumos/update/{id} - Actualizar un insumo
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->model->find($id)) {
            if ($this->model->update($id, $data)) {
                $response = [
                    'status' => 200,
                    'message' => 'Insumo actualizado exitosamente'
                ];
                return redirect()->to('/insumos')->with('message', $response['message']);
            }
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/insumos')->with('error', 'No se encontró el insumo con ID: ' . $id);
    }

    // DELETE /insumos/{id} - Eliminar un insumo
    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            if ($this->model->delete($id)) {
                $response = [
                    'status' => 200,
                    'message' => 'Insumo eliminado exitosamente'
                ];
                return redirect()->to('/insumos')->with('message', $response['message']);
            }
            return redirect()->to('/insumos')->with('error', 'Error al eliminar el insumo');
        }

        return redirect()->to('/insumos')->with('error', 'No se encontró el insumo con ID: ' . $id);
    }

}



/*
Datos de Prueba
{
    "codigo_abas": 24567890,
    "nombre_insumo": "Alcohol",
    "cantidad_insumo": "50",
    "estado_insumo": 1,
    "clasificacion_insumo": 1,
    "disponibilidad_insumo": 1
}
*/