<?php
namespace App\Controllers;

use App\Models\LoteModel;
use App\Models\InsumoModel;
use App\Models\ProveedorModel;
use App\Models\ProcedenciaModel;
use App\Models\TipoCompraModel;

class LoteController extends BaseController
{
    protected $loteModel;
    protected $insumoModel;
    protected $proveedorModel;
    protected $procedenciaModel;
    protected $tipocompraModel;

    public function __construct()
    {
        $this->loteModel = new LoteModel();
        $this->insumoModel = new InsumoModel();
        $this->proveedorModel = new ProveedorModel();
        $this->procedenciaModel = new ProcedenciaModel();
        $this->tipocompraModel = new TipoCompraModel();
    }

    // GET /lotes
    public function index()
    {
        $orden = $this->request->getGet('orden') ?? 'asc';
        $lotes = $this->loteModel->orderBy('FECHA_VENCIMIENTO', $orden)->findAll();

        // Convertir IDs en nombres legibles
        foreach ($lotes as &$lote) {
            $lote['INSUMO_NOMBRE'] = $this->findValue($this->insumoModel->findAll(), 'ID_INSUMO', $lote['ID_INSUMO_LOTE'], 'NOMBRE_INSUMO');
            $lote['PROVEEDOR_NOMBRE'] = $this->findValue($this->proveedorModel->findAll(), 'ID_PROVEEDOR', $lote['ID_PROVEEDOR_LOTE'], 'NOMBRE_PROVEEDOR');
            $lote['PROCEDENCIA_NOMBRE'] = $this->findValue($this->procedenciaModel->findAll(), 'ID_PROCEDENCIA', $lote['ID_PROCEDENCIA_LOTE'], 'NOMBRE_PROCEDENCIA');
            $lote['TIPO_COMPRA_NOMBRE'] = $this->findValue($this->tipocompraModel->findAll(), 'ID_TIPO_COMPRA', $lote['ID_TIPO_COMPRA_LOTE'], 'NOMBRE_TIPO_COMPRA');
        }

        return $this->renderView('modules/lotes/index', [
            'lotes' => $lotes,
            'orden' => $orden
        ]);
    }

    // GET /lotes/create
    public function create()
    {
        return $this->renderView('modules/lotes/create', [
            'insumos' => $this->insumoModel->findAll(),
            'proveedores' => $this->proveedorModel->findAll(),
            'procedencias' => $this->procedenciaModel->findAll(),
            'tiposcompras' => $this->tipocompraModel->findAll()
        ]);
    }

    // POST /lotes/store
    public function store()
    {
        $data = $this->request->getPost();

        if ($this->loteModel->insert($data)) {
            return redirect()->to('/lotes')->with('message', 'Lote creado exitosamente');
        }
        return redirect()->back()->withInput()->with('errors', $this->loteModel->errors());
    }

    // GET /lotes/edit/{id}
    public function edit($id = null)
    {
        $lote = $this->loteModel->find($id);
        if (!$lote) {
            return redirect()->to('/lotes')->with('error', 'No se encontró el lote con ID: ' . $id);
        }

        return $this->renderView('modules/lotes/edit', [
            'lote' => $lote,
            'insumos' => $this->insumoModel->findAll(),
            'proveedores' => $this->proveedorModel->findAll(),
            'procedencias' => $this->procedenciaModel->findAll(),
            'tiposcompras' => $this->tipocompraModel->findAll()
        ]);
    }

    // POST /lotes/update/{id}
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->loteModel->update($id, $data)) {
            return redirect()->to('/lotes')->with('message', 'Lote actualizado exitosamente');
        }
        return redirect()->back()->withInput()->with('errors', $this->loteModel->errors());
    }

    // GET /lotes/delete/{id}
    public function delete($id = null)
    {
        if ($this->loteModel->delete($id)) {
            return redirect()->to('/lotes')->with('message', 'Lote eliminado exitosamente');
        }
        return redirect()->to('/lotes')->with('error', 'Error al eliminar el lote');
    }

    // 🔎 Utilidad interna para convertir ID en nombres
    private function findValue($array, $keyMatch, $valueMatch, $keyReturn)
    {
        foreach ($array as $row) {
            if ($row[$keyMatch] == $valueMatch) {
                return $row[$keyReturn];
            }
        }
        return null;
    }
}
