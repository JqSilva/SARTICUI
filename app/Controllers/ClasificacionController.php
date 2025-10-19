<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ClasificacionModel;

// Controlador de Clasificación

class ClasificacionController extends ResourceController
{
    protected $modelName = 'App\Models\ClasificacionModel';
    protected $format = 'json';

    // GET /clasificaciones - Obtener todas las clasificaciones
    public function index()
    {
        $clasificaciones = $this->model->findAll();

        // Convertir estado_clasificacion a texto
        foreach ($clasificaciones as &$clasificacion) {
            $clasificacion['ESTADO_CLASIFICACION'] = $clasificacion['ESTADO_CLASIFICACION'] == 1 ? 'Activa' : 'Inactiva';
        }

        // Pasar los datos de las clasificaciones a la vista
        return view('clasificaciones/index', ['clasificaciones' => $clasificaciones]);
    }

    // GET /clasificaciones/create - Mostrar el formulario para crear una clasificacion
    public function create()
    {
        return view('clasificaciones/create');
    }

    // POST /clasificaciones - Crear una nueva clasificacion
    public function store()
    {
        $data = $this->request->getPost();

        if ($this->model->insert($data)) {
            return redirect()->to(base_url('/clasificaciones'))->with('message', 'Clasificación creada exitosamente');
        }
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    // GET /clasificaciones/edit/{id} - Mostrar el formulario para editar una clasificacion
    public function edit($id = null)
    {
        $clasificacion = $this->model->find($id);
        if ($clasificacion) {
            return view('clasificaciones/edit', ['clasificacion' => $clasificacion]);
        }
        return redirect()->to('/clasificaciones')->with('error', 'No se encontró la clasificación con ID: ' . $id);
    }

    // POST /clasificaciones/update/{id} - Actualizar una clasificacion
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->model->find($id)) {
            if ($this->model->update($id, $data)) {
                $response = [
                    'status' => 200,
                    'message' => 'Clasificación actualizada exitosamente'
                ];
                return redirect()->to('/clasificaciones')->with('message', $response['message']);
            }
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/clasificaciones')->with('error', 'No se encontró la clasificación con ID: ' . $id);
    }

    // DELETE /clasificaciones/{id} - Eliminar una clasificacion
    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            if ($this->model->delete($id)) {
                $response = [
                    'status' => 200,
                    'message' => 'Clasificación eliminada exitosamente'
                ];
                return redirect()->to('/clasificaciones')->with('message', $response['message']);
            }
            return redirect()->to('/clasificaciones')->with('error', 'Error al eliminar la clasificación');
        }

        return redirect()->to('/clasificaciones')->with('error', 'No se encontró la clasificación con ID: ' . $id);
    }
}

/*
Datos de Prueba
{
    "nombre_clasificacion": "Aguja",
    "dias_postapertura_clasificacion": 0,
    "contenido_base": "Unidad",
    "estado_clasificacion": 1
}

{
    "nombre_clasificacion": "Alcohol",
    "dias_postapertura_clasificacion": 5,
    "contenido_base": "Mililitros",
    "estado_clasificacion": 1
}
*/