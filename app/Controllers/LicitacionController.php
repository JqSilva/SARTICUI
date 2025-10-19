<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\LicitacionModel;
use App\Models\ProveedorModel;
use App\Models\InsumoModel;

// Controlador de Licitación

class LicitacionController extends ResourceController
{
    protected $modelName = 'App\Models\LicitacionModel';
    protected $format = 'json';

    // GET /licitaciones - Obtener todas las licitaciones
    public function index()
    {
        // Obtener todas las licitaciones
        $licitaciones = $this->model->findAll();

        // Obtener los proveedores e insumos
        $proveedorModel = new ProveedorModel();
        $insumoModel = new InsumoModel();

        $proveedores = $proveedorModel->findAll();
        $insumos = $insumoModel->findAll();

        // Convertir estado_licitacion a texto
        foreach ($licitaciones as &$licitacion){

            // Obtener nombres de proveedor e insumo
            foreach ($proveedores as $proveedor) {
                if ($licitacion['ID_PROVEEDOR_LICITACION'] == $proveedor['ID_PROVEEDOR']) {
                    $licitacion['PROVEEDOR_NOMBRE'] = $proveedor['NOMBRE_PROVEEDOR'];
                    break;
                }
            }

            foreach ($insumos as $insumo) {
                if ($licitacion['ID_INSUMO_LICITACION'] == $insumo['ID_INSUMO']) {
                    $licitacion['INSUMO_NOMBRE'] = $insumo['NOMBRE_INSUMO'];
                    break;
                }
            }
        }

            // Pasar los datos a la vista
            return view('licitaciones/index', [
                'licitaciones' => $licitaciones,
                'proveedores' => $proveedores,
                'insumos' => $insumos
            ]);
    }

    // GET /licitaciones/create - Mostrar el formulario para crear un licitacion
    public function create()
    {
        // Obtener datos de las tablas Proveedor e Insumos
        $proveedorModel = new ProveedorModel();
        $insumoModel = new InsumoModel();

        $proveedores = $proveedorModel->findAll();
        $insumos = $insumoModel->findAll();

        // Pasar los datos a la vista
        return view('licitaciones/create', [
            'proveedores' => $proveedores,
            'insumos' => $insumos
        ]);
    }

    // POST /licitaciones - Crear una nueva licitacion
    public function store()
    {
        $data = $this->request->getPost();

        if ($this->model->insert($data)) {
            return redirect()->to(base_url('/licitaciones'))->with('message', 'Licitación creado exitosamente');
        }
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    // GET /licitaciones/edit/{id} - Mostrar el formulario para editar una licitacion
    public function edit($id = null)
    {
        $licitacion = $this->model->find($id);

        if ($licitacion) {
            // Obtener datos de las tablas Proveedor e Insumo
            $proveedorModel = new ProveedorModel();
            $insumoModel = new InsumoModel();

            $proveedores = $proveedorModel->findAll();
            $insumos = $insumoModel->findAll();

            // Pasar los datos a la vista
            return view('licitaciones/edit', [
                'licitacion' => $licitacion,
                'proveedores' => $proveedores,
                'insumos' => $insumos
            ]);
        }
        return redirect()->to('/licitaciones')->with('error', 'No se encontró el licitacion con ID: ' . $id);
    }

    // POST /licitaciones/update/{id} - Actualizar una licitacion
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->model->find($id)) {
            if ($this->model->update($id, $data)) {
                $response = [
                    'status' => 200,
                    'message' => 'Licitacion actualizado exitosamente'
                ];
                return redirect()->to('/licitaciones')->with('message', $response['message']);
            }
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/licitaciones')->with('error', 'No se encontró el licitacion con ID: ' . $id);
    }

    // DELETE /licitaciones/{id} - Eliminar una licitacion
    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            if ($this->model->delete($id)) {
                $response = [
                    'status' => 200,
                    'message' => 'Licitacion eliminado exitosamente'
                ];
                return redirect()->to('/licitaciones')->with('message', $response['message']);
            }
            return redirect()->to('/licitaciones')->with('error', 'Error al eliminar el licitacion');
        }

        return redirect()->to('/licitaciones')->with('error', 'No se encontró el licitacion con ID: ' . $id);
    }
}

/*

Datos de Prueba
{
    "id_publico": "LIC-2024-001",
    "nombre_licitacion": "Ejemplo Licitación",
    "resolucion_exenta": 123,
    "referencia": 456,
    "monto_licitado": 1000000,
    "fecha_inicio": "2024-01-21",
    "fecha_final": "2024-12-31",
    "estado_licitacion": 1,
    "observacion_licitacion": "Observación de ejemplo"
}
*/