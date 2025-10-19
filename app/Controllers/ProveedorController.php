<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ProveedorModel;

// Controlador de Proveedor

class ProveedorController extends ResourceController
{
    protected $modelName = 'App\Models\ProveedorModel';
    protected $format = 'json';

    // GET /proveedores - Obtener todos los proveedores
    public function index()
    {
        $proveedores = $this->model->findAll();

        // Convertir estado_proveedor a texto
        foreach ($proveedores as &$proveedor) {
            $proveedor['ESTADO_PROVEEDOR'] = $proveedor['ESTADO_PROVEEDOR'] == 1 ? 'Activo' : 'Inactivo';
        }

        // Pasar los datos de los proveedores a la vista
        return view('proveedores/index', ['proveedores' => $proveedores]);
    }

    // GET /licitaciones/create - Mostrar el formulario para crear un proveedor
    public function create()
    {
        return view('proveedores/create');
    }

    // POST /proveedores  -  Crear un nuevo proveedor
    public function store()
    {
        $data = $this->request->getPost();

        if ($this->model->insert($data)) {
            return redirect()->to(base_url('/proveedores'))->with('message', 'Proveedor creado exitosamente');
        }
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    // GET /proveedores/edit/{rut} - Mostrar el formulario para editar un proveedor
    public function edit($rut = null)
    {
        $proveedor = $this->model->find($rut);
        if ($proveedor) {
            return view('proveedores/edit', ['proveedor' => $proveedor]);
        }
        return redirect()->to('/proveedores')->with('error', 'No se encontró el proveedor con RUT: ' . $rut);
    }

    // POST /proveedores/update/{rut} - Actualizar un proveedor
    public function update($rut = null)
    {
        $data = $this->request->getPost();

        if ($this->model->find($rut)) {
            if ($this->model->update($rut, $data)) {
                $response = [
                    'status' => 200,
                    'message' => 'Proveedor actualizado exitosamente'
                ];
                return redirect()->to('/proveedores')->with('message', $response['message']);
            }
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/proveedores')->with('error', 'No se encontró el proveedor con RUT: ' . $rut);
    }

    // DELETE /proveedores/{rut} - Eliminar un proveedor
    public function delete($rut = null)
    {
        if ($this->model->find($rut)) {
            if ($this->model->delete($rut)) {
                $response = [
                    'status' => 200,
                    'message' => 'Proveedor eliminado exitosamente'
                ];
                return redirect()->to('/proveedores')->with('message', $response['message']);
            }
            return redirect()->to('/proveedores')->with('error', 'Error al eliminar el proveedor');
        }

        return redirect()->to('/proveedores')->with('error', 'No se encontró el proveedor con RUT: ' . $rut);
    }
}




/*
Datos de Prueba
{
    "rut_proveedor": 24567890,
    "nombre_contacto": "Juan Pérez",
    "direccion_proveedor": "Calle Ejemplo 123",
    "numero_contacto": 912345678,
    "correo_contacto": "juan.perez@ejemplo.com",
    "estado_proveedor": 1
}

*/