<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\TipoCompraModel;

// Controlador de Tipo de Compra

class TipoCompraController extends ResourceController
{
    protected $modelName = 'App\Models\TipoCompraModel';
    protected $format = 'json';

    // GET /tiposcompras - Obtener todos los tipos de compras
    public function index()
    {
        $tiposcompras = $this->model->findAll();

        // Convertir estado_tipocompra a texto
        foreach ($tiposcompras as &$tipocompra) {
            $tipocompra['ESTADO_TIPO_COMPRA'] = $tipocompra['ESTADO_TIPO_COMPRA'] == 1 ? 'Activa' : 'Inactiva';
        }

        // Pasar los datos de los tipos de compras a la vista
        return view('tiposcompras/index', ['tiposcompras' => $tiposcompras]);
    }

    // GET /tiposcompras/create - Mostrar el formulario para crear un tipo de compra
    public function create()
    {
        return view('tiposcompras/create');
    }

    // POST /tiposcompras - Crear un nuevo tipo de compra
    public function store()
    {
        $data = $this->request->getPost();

        if ($this->model->insert($data)) {
            return redirect()->to(base_url('/tiposcompras'))->with('message', 'Tipo de Compra creado exitosamente');
        }
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    // GET /tiposcompras/edit/{id} - Mostrar el formulario para editar un tipo de compra
    public function edit($id = null)
    {
        $tipocompra = $this->model->find($id);
        if ($tipocompra) {
            return view('tiposcompras/edit', ['tipocompra' => $tipocompra]);
        }
        return redirect()->to('/tiposcompras')->with('error', 'No se encontró el tipo de compra con ID: ' . $id);
    }

    // POST /tiposcompras/update/{id} - Actualizar un tipo de compra
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->model->find($id)) {
            if ($this->model->update($id, $data)) {
                $response = [
                    'status' => 200,
                    'message' => 'Tipo de Compra actualizado exitosamente'
                ];
                return redirect()->to('/tiposcompras')->with('message', $response['message']);
            }
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/tiposcompras')->with('error', 'No se encontró el tipo de compra con ID: ' . $id);
    }

    // DELETE /tiposcompras/{id} - Eliminar un tipo de compra
    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            if ($this->model->delete($id)) {
                $response = [
                    'status' => 200,
                    'message' => 'Tipo de Compra eliminado exitosamente'
                ];
                return redirect()->to('/tiposcompras')->with('message', $response['message']);
            }
            return redirect()->to('/tiposcompras')->with('error', 'Error al eliminar el tipo de compra');
        }

        return redirect()->to('/tiposcompras')->with('error', 'No se encontró el tipo de compra con ID: ' . $id);
    }
}

/*
Datos de Prueba
{
    "nombre_tipo_compra": "Clínicas",
    "estado_tipo_compra": 1
}

{
    "nombre_tipo_compra": "Consignados",
    "estado_tipo_compra": 1
}
*/