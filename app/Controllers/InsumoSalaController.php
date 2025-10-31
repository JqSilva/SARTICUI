<?php
namespace App\Controllers;

use App\Models\InsumoSalaModel;
use App\Models\LoteModel;
use App\Models\SalaModel;
use App\Models\InsumoModel;
use App\Models\BodegaModel;

class InsumoSalaController extends BaseController
{
    protected $insumoSalaModel;
    protected $loteModel;
    protected $salaModel;
    protected $insumoModel;
    protected $bodegaModel;

    public function __construct()
    {
        $this->insumoSalaModel = new InsumoSalaModel();
        $this->loteModel       = new LoteModel();
        $this->salaModel       = new SalaModel();
        $this->insumoModel     = new InsumoModel();
        $this->bodegaModel     = new BodegaModel();
    }

    /**
     * Renderiza el listado de insumos en sala, con prefijo opcional de rol
     * Ejemplo: 'bodeguero', 'administrador'
     */
    private function renderIndex(?string $rolePrefix = null)
    {
        $insumosSala = $this->insumoSalaModel
            ->where('CANTIDAD_INSUMO_SALA >', 0)
            ->findAll();

        $lotes   = $this->loteModel->findAll();
        $salas   = $this->salaModel->findAll();
        $insumos = $this->insumoModel->findAll();

        // Construcción de nombres legibles
        foreach ($insumosSala as &$item) {
            foreach ($lotes as $lote) {
                if ($item['ID_LOTE_INSUMO_SALA'] == $lote['ID_LOTE']) {
                    $item['CODIGO_INSUMO'] = $lote['CODIGO_PRODUCTO_LOTE'];
                    $item['COD_INSUMO']    = $lote['ID_INSUMO_LOTE'];
                    break;
                }
            }
            foreach ($insumos as $insumo) {
                if (isset($item['COD_INSUMO']) && $item['COD_INSUMO'] == $insumo['ID_INSUMO']) {
                    $item['NOMBRE_INSUMO'] = $insumo['NOMBRE_INSUMO'];
                    break;
                }
            }
            foreach ($salas as $sala) {
                if ($item['ID_SALA_INSUMO_SALA'] == $sala['ID_SALA']) {
                    $item['SALA_NOMBRE'] = $sala['NOMBRE_SALA'];
                    break;
                }
            }
        }
        unset($item);

        $data = [
            'insumossalas' => $insumosSala,
            'lotes'        => $lotes,
            'salas'        => $salas,
        ];

        $view = $rolePrefix
            ? "modules/insumossalas/{$rolePrefix}/index"
            : "modules/insumossalas/index";

        return $this->renderView($view, $data);
    }

    // GET /insumossalas
    public function index() { return $this->renderIndex(); }

    // GET /bodeguero/insumossalas
    public function indexBodeguero() { return $this->renderIndex('bodeguero'); }

    // GET /administrador/insumossalas
    public function indexAdmin() { return $this->renderIndex('administrador'); }

    // GET /insumossalas/create
    public function create()
    {
        return $this->renderView('modules/insumossalas/create', [
            'lotes'   => $this->loteModel->findAll(),
            'salas'   => $this->salaModel->findAll(),
            'insumos' => $this->insumoModel->findAll()
        ]);
    }

    // POST /insumossalas/store
    public function store()
    {
        $data = $this->request->getPost();
        $cantidadSolicitada = (int) $data['CANTIDAD_INSUMO_SALA'];

        $insumosEnBodega = $this->bodegaModel->obtenerInsumosEnBodega();
        $cantidadDisponible = 0;

        foreach ($insumosEnBodega as $lote) {
            if ($lote['ID_LOTE'] == $data['ID_LOTE_INSUMO_SALA']) {
                $cantidadDisponible = (int) $lote['CANTIDAD_DISPONIBLE'];
                break;
            }
        }

        if ($cantidadSolicitada > $cantidadDisponible) {
            return redirect()->to('/insumossalas')->with('error', 'Cantidad ingresada supera la disponible.');
        }

        if ($this->insumoSalaModel->insert($data)) {
            return redirect()->to('/insumossalas')->with('message', 'Insumo registrado correctamente.');
        }

        return redirect()->back()->withInput()->with('errors', $this->insumoSalaModel->errors());
    }

    // GET /insumossalas/edit/{id}
    public function edit($id = null)
    {
        $insumoSala = $this->insumoSalaModel->find($id);
        if (!$insumoSala)
            return redirect()->to('/insumossalas')->with('error', 'Insumo no encontrado.');

        return $this->renderView('modules/insumossalas/edit', [
            'insumosala' => $insumoSala,
            'lotes'      => $this->loteModel->findAll(),
            'salas'      => $this->salaModel->findAll(),
            'insumos'    => $this->insumoModel->findAll()
        ]);
    }

    // POST /insumossalas/update/{id}
    public function update($id = null)
    {
        $data = $this->request->getPost();
        if ($this->insumoSalaModel->update($id, $data)) {
            return redirect()->to('/insumossalas')->with('message', 'Insumo actualizado exitosamente.');
        }
        return redirect()->back()->withInput()->with('errors', $this->insumoSalaModel->errors());
    }

    // GET /insumossalas/delete/{id}
    public function delete($id = null)
    {
        if ($this->insumoSalaModel->delete($id)) {
            return redirect()->to('/insumossalas')->with('message', 'Insumo eliminado correctamente.');
        }
        return redirect()->to('/insumossalas')->with('error', 'Error al eliminar el insumo.');
    }
}
