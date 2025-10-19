<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\SalaModel;
use App\Models\SubunidadModel;

// Controlador de Sala

class SalaController extends ResourceController
{
    protected $modelName = 'App\Models\SalaModel';
    protected $format = 'json';

    // GET /salas - Obtener todas las salas
    public function index()
    {
        // Obtener todas las salas
        $salas = $this->model->findAll();

        // Obtener las subunidades
        $subunidadModel = new SubunidadModel();
        $subunidades = $subunidadModel->findAll();

        // Convertir estado_sala a texto
        foreach ($salas as &$sala) {
            // Obtener nombres de subunidad
            foreach ($subunidades as $subunidad) {
                if ($sala['ID_SUBUNIDAD_SALA'] == $subunidad['ID_SUBUNIDAD']) {
                    $sala['SUBUNIDAD_NOMBRE'] = $subunidad['NOMBRE_SUBUNIDAD'];
                    break;
                }
            }

            $sala['ESTADO_SALA'] = $sala['ESTADO_SALA'] == 1 ? 'Activa' : 'Inactiva';
        }

        // Pasar los datos a la vista
        return view('salas/index', [
            'salas' => $salas,
            'subunidades' => $subunidades
        ]);
    }

    // GET /salas/create - Mostrar el formulario para crear una sala
    public function create()
    {
        // Obtener datos de la tabla subunidad
        $subunidadModel = new SubunidadModel();

        $subunidades = $subunidadModel->findAll();

        // Pasar los datos a la vista
        return view('salas/create', [
            'subunidades' => $subunidades
        ]);
    }

    // POST /salas - Crear una nueva sala
    public function store()
    {
        $data = $this->request->getPost();

        if ($this->model->insert($data)) {
            return redirect()->to(base_url('/salas'))->with('message', 'Sala creada exitosamente');
        }
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    // GET /salas/edit/{id} - Mostrar el formulario para editar una sala
    public function edit($id = null)
    {
        $sala = $this->model->find($id);

        if ($sala) {
            // Obtener datos de la tabla subunidad
            $subunidadModel = new SubunidadModel();

            $subunidades = $subunidadModel->findAll();

            // Pasar los datos a la vista
            return view('salas/edit', [
                'sala' => $sala,
                'subunidades' => $subunidades
            ]);
        }
        return redirect()->to('/salas')->with('error', 'No se encontró el sala con ID: ' . $id);
    }

    // POST /salas/update/{id} - Actualizar una sala
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->model->find($id)) {
            if ($this->model->update($id, $data)) {
                $response = [
                    'status' => 200,
                    'message' => 'sala actualizado exitosamente'
                ];
                return redirect()->to('/salas')->with('message', $response['message']);
            }
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/salas')->with('error', 'No se encontró el sala con ID: ' . $id);
    }

    // DELETE /salas/{id} - Eliminar una sala
    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            if ($this->model->delete($id)) {
                $response = [
                    'status' => 200,
                    'message' => 'sala eliminado exitosamente'
                ];
                return redirect()->to('/salas')->with('message', $response['message']);
            }
            return redirect()->to('/salas')->with('error', 'Error al eliminar el sala');
        }

        return redirect()->to('/salas')->with('error', 'No se encontró el sala con ID: ' . $id);
    }
}

/*
Datos de Prueba
{
    "id_sala": 20570463,
    "contrasena": "123456"
}
*/