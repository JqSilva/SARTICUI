<?php
namespace App\Controllers;

use App\Models\UsoPacienteModel;
use App\Models\InsumoSalaModel;
use App\Models\PacienteModel;
use App\Models\LoteModel;
use App\Models\InsumoModel;
use App\Models\SalaModel;
use App\Models\TipoRegistroModel;
use App\Controllers\TrazabilidadAccionController;

class UsoPacienteController extends BaseController
{
    protected $usoPacienteModel;
    protected $insumoSalaModel;
    protected $pacienteModel;
    protected $loteModel;
    protected $insumoModel;
    protected $salaModel;
    protected $tipoRegistroModel;

    public function __construct()
    {
        $this->usoPacienteModel = new UsoPacienteModel();
        $this->insumoSalaModel = new InsumoSalaModel();
        $this->pacienteModel = new PacienteModel();
        $this->loteModel = new LoteModel();
        $this->insumoModel = new InsumoModel();
        $this->salaModel = new SalaModel();
        $this->tipoRegistroModel = new TipoRegistroModel();
    }

    public function index()
    {
        $usospacientes = $this->usoPacienteModel->findAll();
        $insumossalas = $this->insumoSalaModel->findAll();
        $pacientes = $this->pacienteModel->findAll();
        $insumos = $this->insumoModel->findAll();
        $salas = $this->salaModel->findAll();
        $tiposregistros = $this->tipoRegistroModel->findAll();
        $lotes = $this->loteModel->findAll();

        foreach ($usospacientes as &$uso) {
            foreach ($insumossalas as $insumosala) {
                if ($uso['ID_INSUMO_SALA_USO'] == $insumosala['ID_INSUMO_SALA']) {
                    foreach ($lotes as $lote) {
                        if ($lote['ID_LOTE'] == $insumosala['ID_LOTE_INSUMO_SALA']) {
                            $uso['NOMBRE_INSUMO'] = $this->findName($insumos, $lote['ID_INSUMO_LOTE']);
                            $uso['COSTO_UNITARIO'] = $lote['COSTO_UNITARIO_LOTE'];
                            break 2;
                        }
                    }
                }
            }

            $uso['PACIENTE_NOMBRE'] = $this->findFullName($pacientes, $uso['ID_PACIENTE_USO']);
            $uso['SALA_NOMBRE'] = $this->findValue($salas, 'ID_SALA', $uso['ID_SALA_USO'], 'NOMBRE_SALA');
            $uso['TIPO_REGISTRO_NOMBRE'] = $this->findValue($tiposregistros, 'ID_TIPO_REGISTRO', $uso['ID_TIPO_REGISTRO_USO'], 'NOMBRE_TIPO_REGISTRO');
        }

        return $this->renderView('modules/usospacientes/index', [
            'usospacientes' => $usospacientes,
        ]);
    }

    public function create()
    {
        // Agrega nombres de insumos y costos unitarios
        $insumossalas = $this->insumoSalaModel->findAll();
        $insumos = $this->insumoModel->findAll();
        $lotes = $this->loteModel->findAll();

        foreach ($insumossalas as &$is) {
            foreach ($lotes as $lote) {
                if ($lote['ID_LOTE'] == $is['ID_LOTE_INSUMO_SALA']) {
                    foreach ($insumos as $insumo) {
                        if ($lote['ID_INSUMO_LOTE'] == $insumo['ID_INSUMO']) {
                            $is['NOMBRE_INSUMO'] = $insumo['NOMBRE_INSUMO'];
                            $is['COSTO_UNITARIO'] = $lote['COSTO_UNITARIO_LOTE'];
                            break;
                        }
                    }
                    break;
                }
            }
        }

        return $this->renderView('modules/usospacientes/create', [
            'insumossalas' => $insumossalas,
            'pacientes' => $this->pacienteModel->findAll(),
            'salas' => $this->salaModel->findAll(),
            'tiposregistros' => $this->tipoRegistroModel->findAll(),
        ]);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $insumoSala = $this->insumoSalaModel->find($data['ID_INSUMO_SALA_USO']);

        if (!$insumoSala)
            return redirect()->to('/usospacientes')->with('error', 'El insumo seleccionado no existe.');

        $cantidadDisponible = (int) $insumoSala['CANTIDAD_INSUMO_SALA'];
        $cantidadUtilizada = (int) $data['CANTIDAD_UTILIZADA_USO'];

        if ($cantidadUtilizada > $cantidadDisponible)
            return redirect()->to('/usospacientes')->with('error', 'Cantidad utilizada supera la disponible.');

        if ($this->usoPacienteModel->insert($data)) {
            $this->insumoSalaModel->update($data['ID_INSUMO_SALA_USO'], [
                'CANTIDAD_INSUMO_SALA' => $cantidadDisponible - $cantidadUtilizada
            ]);

            $idInsumo = $this->getInsumoFromSala($data['ID_INSUMO_SALA_USO']);
            $traza = new TrazabilidadAccionController();
            $traza->registrarAccion(session('id'), $idInsumo, $cantidadUtilizada, 'Registro de consumo');

            return redirect()->to('/usospacientes')->with('message', 'Consumo registrado correctamente.');
        }

        return redirect()->back()->withInput()->with('errors', $this->usoPacienteModel->errors());
    }

    public function edit($id = null)
    {
        $usopaciente = $this->usoPacienteModel->find($id);
        if (!$usopaciente)
            return redirect()->to('/usospacientes')->with('error', 'No se encontró el registro.');

        // Traer y enriquecer los insumos de sala con nombres y costos
        $insumossalas = $this->insumoSalaModel->findAll();
        $insumos = $this->insumoModel->findAll();
        $lotes = $this->loteModel->findAll();

        foreach ($insumossalas as &$is) {
            foreach ($lotes as $lote) {
                if ($lote['ID_LOTE'] == $is['ID_LOTE_INSUMO_SALA']) {
                    foreach ($insumos as $insumo) {
                        if ($lote['ID_INSUMO_LOTE'] == $insumo['ID_INSUMO']) {
                            $is['NOMBRE_INSUMO'] = $insumo['NOMBRE_INSUMO'];
                            $is['COSTO_UNITARIO'] = $lote['COSTO_UNITARIO_LOTE'];
                            break;
                        }
                    }
                    break;
                }
            }
        }

        return $this->renderView('modules/usospacientes/edit', [
            'usopaciente' => $usopaciente,
            'insumossalas' => $insumossalas,
            'pacientes' => $this->pacienteModel->findAll(),
            'salas' => $this->salaModel->findAll(),
            'tiposregistros' => $this->tipoRegistroModel->findAll(),
        ]);
    }

    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->usoPacienteModel->update($id, $data)) {
            $idInsumo = $this->getInsumoFromSala($data['ID_INSUMO_SALA_USO']);
            $traza = new TrazabilidadAccionController();
            $traza->registrarAccion(session('id'), $idInsumo, $data['CANTIDAD_UTILIZADA_USO'], 'Modificación de consumo');

            return redirect()->to('/usospacientes')->with('message', 'Uso actualizado correctamente.');
        }

        return redirect()->back()->withInput()->with('errors', $this->usoPacienteModel->errors());
    }

    public function delete($id = null)
    {
        $uso = $this->usoPacienteModel->find($id);
        if ($uso && $this->usoPacienteModel->delete($id)) {
            $idInsumo = $this->getInsumoFromSala($uso['ID_INSUMO_SALA_USO']);
            $traza = new TrazabilidadAccionController();
            $traza->registrarAccion(session('id'), $idInsumo, $uso['CANTIDAD_UTILIZADA_USO'], 'Eliminación de consumo');

            return redirect()->to('/usospacientes')->with('message', 'Registro eliminado correctamente.');
        }

        return redirect()->to('/usospacientes')->with('error', 'Error al eliminar el registro.');
    }

    private function getInsumoFromSala($idInsumoSala)
    {
        $insumoSala = $this->insumoSalaModel->find($idInsumoSala);
        if (!$insumoSala) return null;

        $lote = $this->loteModel->find($insumoSala['ID_LOTE_INSUMO_SALA']);
        return $lote ? $lote['ID_INSUMO_LOTE'] : null;
    }

    private function findName($insumos, $id)
    {
        foreach ($insumos as $i)
            if ($i['ID_INSUMO'] == $id)
                return $i['NOMBRE_INSUMO'];
        return '';
    }

    private function findFullName($pacientes, $id)
    {
        foreach ($pacientes as $p)
            if ($p['ID_PACIENTE'] == $id)
                return $p['NOMBRE_PACIENTE'] . ' ' . $p['APATERNO_PACIENTE'];
        return '';
    }

    private function findValue($array, $keyMatch, $valueMatch, $keyReturn)
    {
        foreach ($array as $row)
            if ($row[$keyMatch] == $valueMatch)
                return $row[$keyReturn];
        return null;
    }
}
