<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\LoteModel;
use App\Models\InsumoModel;
use App\Models\ProveedorModel;
use App\Models\ProcedenciaModel;
use App\Models\TipoCompraModel;

// Controlador de Lote

class LoteController extends ResourceController
{
    protected $modelName = 'App\Models\LoteModel';
    protected $format = 'json';

    // GET /lotes - Obtener todos los lotes
    public function index()
    {
        $orden = $this->request->getGet('orden') ?? 'asc'; // Valor por defecto: ascendente

        // Obtener todos los lotes ordenados por fecha de vencimiento
        $lotes = $this->model->orderBy('FECHA_VENCIMIENTO', $orden)->findAll();

        // Obtener los insumos, proveedores, procedencia y tipo de compra
        $insumoModel = new InsumoModel();
        $proveedorModel = new ProveedorModel();
        $procedenciaModel = new ProcedenciaModel();
        $tipocompraModel = new TipoCompraModel();

        $insumos = $insumoModel->findAll();
        $proveedores = $proveedorModel->findAll();
        $procedencias = $procedenciaModel->findAll();
        $tiposcompras = $tipocompraModel->findAll();

        // Convertir ID a nombres correspondientes
        foreach ($lotes as &$lote) {
            foreach ($insumos as $insumo) {
                if ($lote['ID_INSUMO_LOTE'] == $insumo['ID_INSUMO']) {
                    $lote['INSUMO_NOMBRE'] = $insumo['NOMBRE_INSUMO'];
                    break;
                }
            }
            foreach ($proveedores as $proveedor) {
                if ($lote['ID_PROVEEDOR_LOTE'] == $proveedor['ID_PROVEEDOR']) {
                    $lote['PROVEEDOR_NOMBRE'] = $proveedor['NOMBRE_PROVEEDOR'];
                    break;
                }
            }
            foreach ($procedencias as $procedencia) {
                if ($lote['ID_PROCEDENCIA_LOTE'] == $procedencia['ID_PROCEDENCIA']) {
                    $lote['PROCEDENCIA_NOMBRE'] = $procedencia['NOMBRE_PROCEDENCIA'];
                    break;
                }
            }
            foreach ($tiposcompras as $tipocompra) {
                if ($lote['ID_TIPO_COMPRA_LOTE'] == $tipocompra['ID_TIPO_COMPRA']) {
                    $lote['TIPO_COMPRA_NOMBRE'] = $tipocompra['NOMBRE_TIPO_COMPRA'];
                    break;
                }
            }
        }

        // Pasar los datos a la vista
        return view('lotes/index', [
            'lotes' => $lotes,
            'insumos' => $insumos,
            'proveedores' => $proveedores,
            'procedencias' => $procedencias,
            'tiposcompras' => $tiposcompras,
            'orden' => $orden // Para mantener la selección en la vista
        ]);
    }

    // GET /lotes/create - Mostrar el formulario para crear un lote
    public function create()
    {
        // Obtener datos de las tablas insumo, proveedor, procedencia y tipo de compra
        $insumoModel = new InsumoModel();
        $proveedorModel = new ProveedorModel();
        $procedenciaModel = new ProcedenciaModel();
        $tipocompraModel = new TipoCompraModel();

        $insumos = $insumoModel->findAll();
        $proveedores = $proveedorModel->findAll();
        $procedencias = $procedenciaModel->findAll();
        $tiposcompras = $tipocompraModel->findAll();

        // Pasar los datos a la vista
        return view('lotes/create', [
            'insumos' => $insumos,
            'proveedores' => $proveedores,
            'procedencias' => $procedencias,
            'tiposcompras' => $tiposcompras
        ]);
    }

    // POST /lotes - Crear un nuevo lote
    public function store()
    {
        $data = $this->request->getPost();

        if ($this->model->insert($data)) {
            return redirect()->to(site_url('/lotes'))->with('message', 'Lotes creado exitosamente');
        }
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    // GET /lotes/edit/{id} - Mostrar el formulario para editar un lote
    public function edit($id = null)
    {
        $lote = $this->model->find($id);

        if ($lote) {
            // Obtener datos de las tablas Insumo, Proveedor, Procedencia y Tipo de Compra
            $insumoModel = new InsumoModel();
            $proveedorModel = new ProveedorModel();
            $procedenciaModel = new ProcedenciaModel();
            $tipocompraModel = new TipoCompraModel();

            $insumos = $insumoModel->findAll();
            $proveedores = $proveedorModel->findAll();
            $procedencias = $procedenciaModel->findAll();
            $tiposcompras = $tipocompraModel->findAll();

            // Pasar los datos a la vista
            return view('lotes/edit', [
                'lote' => $lote,
                'insumos' => $insumos,
                'proveedores' => $proveedores,
                'procedencias' => $procedencias,
                'tiposcompras' => $tiposcompras
            ]);
        }
        return redirect()->to('/lotes')->with('error', 'No se encontró el lote con ID: ' . $id);
    }

    // POST /lotes/update/{id} - Actualizar un lote
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->model->find($id)) {
            if ($this->model->update($id, $data)) {
                $response = [
                    'status' => 200,
                    'message' => 'Lote actualizado exitosamente'
                ];
                return redirect()->to('/lotes')->with('message', $response['message']);
            }
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/lotes')->with('error', 'No se encontró el lote con ID: ' . $id);
    }

    // DELETE /lotes/{id} - Eliminar un lote
    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            if ($this->model->delete($id)) {
                $response = [
                    'status' => 200,
                    'message' => 'Lote eliminado exitosamente'
                ];
                return redirect()->to('/lotes')->with('message', $response['message']);
            }
            return redirect()->to('/lotes')->with('error', 'Error al eliminar el lote');
        }

        return redirect()->to('/lotes')->with('error', 'No se encontró el lote con ID: ' . $id);
    }
}

/*
Datos de Prueba
{
    "marca_lote": "Genérico",
    "codigo_producto": 2424,
    "unidad_sistema_abas": "Botellita",
    "contenido_base": 5,
    "observacion_lote": "Hola que tal",
    "id_proveedor_lote": 20567258,
    "id_insumo_lote": 24567890,
    "id_unidad_lote": 1,
    "id_fecha_vencimiento_lote": 1
}
*/