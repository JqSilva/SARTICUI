<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\TipoMantencionModel;

// Controlador de Tipo de Mantención

class TipoMantencionController extends ResourceController
{
    protected $modelName = 'App\Models\TipoMantencionModel';
    protected $format = 'json';

    // GET /tiposmantenciones - Obtener todos los tipos de mantenciones
    public function index()
    {
        $tiposmantenciones = $this->model->findAll();

        // Convertir estado_tipo_mantencion a texto
        foreach ($tiposmantenciones as &$tipomantencion) {
            $tipomantencion['ESTADO_TIPO_MANTENCION'] = $tipomantencion['ESTADO_TIPO_MANTENCION'] == 1 ? 'Activa' : 'Inactiva';
        }

        // Pasar los datos de las tiposmantenciones a la vista
        return view('tiposmantenciones/index', ['tiposmantenciones' => $tiposmantenciones]);
    }

    // GET /tiposmantenciones/create - Mostrar el formulario para crear un tipo de mantencion
    public function create()
    {
        return view('tiposmantenciones/create');
    }

    // POST /tiposmantenciones - Crear un nuevo tipo de mantencion
    public function store()
    {
        $data = $this->request->getPost();

        if ($this->model->insert($data)) {
            return redirect()->to(base_url('/tiposmantenciones'))->with('message', 'Tipo de Mantención creada exitosamente');
        }
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    // GET /tiposmantenciones/edit/{id} - Mostrar el formulario para editar un tipo de mantencion
    public function edit($id = null)
    {
        $tipomantencion = $this->model->find($id);
        if ($tipomantencion) {
            return view('tiposmantenciones/edit', ['tipomantencion' => $tipomantencion]);
        }
        return redirect()->to('/tiposmantenciones')->with('error', 'No se encontró la clasificación con ID: ' . $id);
    }

    // POST /tiposmantenciones/update/{id} - Actualizar un tipo de mantencion
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->model->find($id)) {
            if ($this->model->update($id, $data)) {
                $response = [
                    'status' => 200,
                    'message' => 'Tipo de Mantención actualizado exitosamente'
                ];
                return redirect()->to('/tiposmantenciones')->with('message', $response['message']);
            }
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/tiposmantenciones')->with('error', 'No se encontró la clasificación con ID: ' . $id);
    }

    // DELETE /tiposmantenciones/{id} - Eliminar un tipo de mantencion
    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            if ($this->model->delete($id)) {
                $response = [
                    'status' => 200,
                    'message' => 'Tipo de Mantención eliminado exitosamente'
                ];
                return redirect()->to('/tiposmantenciones')->with('message', $response['message']);
            }
            return redirect()->to('/tiposmantenciones')->with('error', 'Error al eliminar la clasificación');
        }

        return redirect()->to('/tiposmantenciones')->with('error', 'No se encontró la clasificación con ID: ' . $id);
    }
}

/*
Datos de Prueba
{
    "NOMBRE_TIPO_MANTENCION": "Preventiva",
    "ESTADO_TIPO_MANTENCION": 1
}

{
    "NOMBRE_TIPO_MANTENCION": "Correctiva",
    "ESTADO_TIPO_MANTENCION": 1
}
*/