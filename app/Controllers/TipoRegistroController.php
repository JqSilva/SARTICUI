<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\TipoRegistroModel;

// Controlador de Tipo de Registro

class TipoRegistroController extends ResourceController
{
    protected $modelName = 'App\Models\TipoRegistroModel';
    protected $format = 'json';

    // GET /tiposregistros - Obtener todos los tipos de registros
    public function index()
    {
        $tiposregistros = $this->model->findAll();

        // Convertir estado_tiporegistro a texto
        foreach ($tiposregistros as &$tiporegistro) {
            $tiporegistro['ESTADO_TIPO_REGISTRO'] = $tiporegistro['ESTADO_TIPO_REGISTRO'] == 1 ? 'Activa' : 'Inactiva';
        }

        // Pasar los datos de los tipos de registros a la vista
        return view('tiposregistros/index', ['tiposregistros' => $tiposregistros]);
    }

    // GET /tiposregistros/create - Mostrar el formulario para crear un tipo de registro
    public function create()
    {
        return view('tiposregistros/create');
    }

    // POST /tiposregistros - Crear un nuevo tipo de registro
    public function store()
    {
        $data = $this->request->getPost();

        if ($this->model->insert($data)) {
            return redirect()->to(base_url('/tiposregistros'))->with('message', 'Tipo de Registro creado exitosamente');
        }
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    // GET /tiposregistros/edit/{id} - Mostrar el formulario para editar un tipo de registro
    public function edit($id = null)
    {
        $tiporegistro = $this->model->find($id);
        if ($tiporegistro) {
            return view('tiposregistros/edit', ['tiporegistro' => $tiporegistro]);
        }
        return redirect()->to('/tiposregistros')->with('error', 'No se encontró el tipo de registro con ID: ' . $id);
    }

    // POST /tiposregistros/update/{id} - Actualizar un tipo de registro
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->model->find($id)) {
            if ($this->model->update($id, $data)) {
                $response = [
                    'status' => 200,
                    'message' => 'Tipo de Compra actualizado exitosamente'
                ];
                return redirect()->to('/tiposregistros')->with('message', $response['message']);
            }
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/tiposregistros')->with('error', 'No se encontró el tipo de registro con ID: ' . $id);
    }

    // DELETE /tiposregistros/{id} - Eliminar un tipo de registro
    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            if ($this->model->delete($id)) {
                $response = [
                    'status' => 200,
                    'message' => 'Tipo de Compra eliminado exitosamente'
                ];
                return redirect()->to('/tiposregistros')->with('message', $response['message']);
            }
            return redirect()->to('/tiposregistros')->with('error', 'Error al eliminar el tipo de registro');
        }

        return redirect()->to('/tiposregistros')->with('error', 'No se encontró el tipo de registro con ID: ' . $id);
    }
}

/*
Datos de Prueba
{
    "NOMBRE_TIPO_REGISTRO": "Devolución",
    "ESTADO_TIPO_REGISTRO": 1
}

{
    "NOMBRE_TIPO_REGISTRO": "Consumido",
    "ESTADO_TIPO_REGISTRO": 1
}
*/