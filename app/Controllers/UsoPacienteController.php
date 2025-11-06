<?php
namespace App\Controllers;

use App\Models\UsoPacienteModel;
use App\Models\InsumoSalaModel;
use App\Models\PacienteModel;
use App\Models\LoteModel;
use App\Models\InsumoModel;
use App\Models\SalaModel;
use App\Models\TipoRegistroModel;

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

    // GET /usospacientes
    public function index()
    {
        $usospacientes = $this->usoPacienteModel->findAll();

        $insumossalas = $this->insumoSalaModel->findAll();
        $pacientes = $this->pacienteModel->findAll();
        $insumos = $this->insumoModel->findAll();
        $salas = $this->salaModel->findAll();
        $tiposregistros = $this->tipoRegistroModel->findAll();
        $lotes = $this->loteModel->findAll();

        foreach ($usospacientes as &$usopaciente) {
            foreach ($insumossalas as $insumosala) {
                if ($usopaciente['ID_INSUMO_SALA_USO'] == $insumosala['ID_INSUMO_SALA']) {
                    $usopaciente['ID_LOTE_INSUMO_SALA'] = $insumosala['ID_LOTE_INSUMO_SALA'];
                    foreach ($lotes as $lote) {
                        if ($lote['ID_LOTE'] == $insumosala['ID_LOTE_INSUMO_SALA']) {
                            $usopaciente['CODIGO_INSUMO'] = $lote['CODIGO_PRODUCTO_LOTE'];
                            $usopaciente['COD_INSUMO'] = $lote['ID_INSUMO_LOTE'];
                            $usopaciente['COSTO_UNITARIO'] = $lote['COSTO_UNITARIO_LOTE'];
                            break;
                        }
                    }
                    break;
                }
            }

            foreach ($insumos as $insumo) {
                if (isset($usopaciente['COD_INSUMO']) && $usopaciente['COD_INSUMO'] == $insumo['ID_INSUMO']) {
                    $usopaciente['NOMBRE_INSUMO'] = $insumo['NOMBRE_INSUMO'];
                    break;
                }
            }

            foreach ($pacientes as $paciente) {
                if ($usopaciente['ID_PACIENTE_USO'] == $paciente['ID_PACIENTE']) {
                    $usopaciente['PACIENTE_NOMBRE'] = $paciente['NOMBRE_PACIENTE'] . ' ' . $paciente['APATERNO_PACIENTE'];
                    break;
                }
            }

            foreach ($salas as $sala) {
                if ($usopaciente['ID_SALA_USO'] == $sala['ID_SALA']) {
                    $usopaciente['SALA_NOMBRE'] = $sala['NOMBRE_SALA'];
                    break;
                }
            }

            foreach ($tiposregistros as $tipo) {
                if ($usopaciente['ID_TIPO_REGISTRO_USO'] == $tipo['ID_TIPO_REGISTRO']) {
                    $usopaciente['TIPO_REGISTRO_NOMBRE'] = $tipo['NOMBRE_TIPO_REGISTRO'];
                    break;
                }
            }
        }

        return $this->renderView('modules/usospacientes/index', [
            'usospacientes' => $usospacientes,
            'insumossalas' => $insumossalas,
            'pacientes' => $pacientes,
            'tiposregistros' => $tiposregistros
        ]);
    }

    // GET /usospacientes/create
    public function create()
    {
        $insumossalas = $this->insumoSalaModel->findAll();
        $pacientes = $this->pacienteModel->findAll();
        $insumos = $this->insumoModel->findAll();
        $lotes = $this->loteModel->findAll();
        $salas = $this->salaModel->findAll();
        $tiposregistros = $this->tipoRegistroModel->findAll();

        foreach ($insumossalas as &$insumosala) {
            foreach ($lotes as $lote) {
                if ($lote['ID_LOTE'] == $insumosala['ID_LOTE_INSUMO_SALA']) {
                    foreach ($insumos as $insumo) {
                        if ($lote['ID_INSUMO_LOTE'] == $insumo['ID_INSUMO']) {
                            $insumosala['NOMBRE_INSUMO'] = $insumo['NOMBRE_INSUMO'];
                            $insumosala['COSTO_UNITARIO'] = $lote['COSTO_UNITARIO_LOTE'];
                            break;
                        }
                    }
                    break;
                }
            }
        }

        return $this->renderView('modules/usospacientes/create', [
            'insumossalas' => $insumossalas,
            'lotes' => $lotes,
            'pacientes' => $pacientes,
            'insumos' => $insumos,
            'salas' => $salas,
            'tiposregistros' => $tiposregistros
        ]);
    }

    // POST /usospacientes/store
    public function store()
    {
        $data = $this->request->getPost();

        $insumoSala = $this->insumoSalaModel->find($data['ID_INSUMO_SALA_USO']);
        if (!$insumoSala) {
            return redirect()->to('/usospacientes')->with('error', 'El insumo seleccionado no existe en sala.');
        }

        $cantidadDisponible = (int) $insumoSala['CANTIDAD_INSUMO_SALA'];
        $cantidadUtilizada = (int) $data['CANTIDAD_UTILIZADA_USO'];

        if ($cantidadUtilizada > $cantidadDisponible) {
            return redirect()->to('/usospacientes')->with('error', 'Cantidad utilizada supera la disponible.');
        }

        $this->usoPacienteModel->insert($data);

        $this->insumoSalaModel->update($data['ID_INSUMO_SALA_USO'], [
            'CANTIDAD_INSUMO_SALA' => $cantidadDisponible - $cantidadUtilizada
        ]);

        return redirect()->to('/usospacientes')->with('message', 'Consumo registrado correctamente.');
    }

    // GET /usospacientes/edit/{id}
    public function edit($id = null)
    {
        $usopaciente = $this->usoPacienteModel->find($id);
        if (!$usopaciente) {
            return redirect()->to('/usospacientes')->with('error', 'No se encontró el registro con ID: ' . $id);
        }

        $insumossalas = $this->insumoSalaModel->findAll();
        $pacientes = $this->pacienteModel->findAll();
        $insumos = $this->insumoModel->findAll();
        $lotes = $this->loteModel->findAll();
        $salas = $this->salaModel->findAll();
        $tiposregistros = $this->tipoRegistroModel->findAll();

        foreach ($insumossalas as &$insumosala) {
            foreach ($lotes as $lote) {
                if ($lote['ID_LOTE'] == $insumosala['ID_LOTE_INSUMO_SALA']) {
                    foreach ($insumos as $insumo) {
                        if ($lote['ID_INSUMO_LOTE'] == $insumo['ID_INSUMO']) {
                            $insumosala['NOMBRE_INSUMO'] = $insumo['NOMBRE_INSUMO'];
                            $insumosala['COSTO_UNITARIO'] = $lote['COSTO_UNITARIO_LOTE'];
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
            'lotes' => $lotes,
            'pacientes' => $pacientes,
            'insumos' => $insumos,
            'salas' => $salas,
            'tiposregistros' => $tiposregistros
        ]);
    }

    // POST /usospacientes/update/{id}
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->usoPacienteModel->update($id, $data)) {
            return redirect()->to('/usospacientes')->with('message', 'Uso de paciente actualizado correctamente.');
        }

        return redirect()->back()->withInput()->with('errors', $this->usoPacienteModel->errors());
    }

    // GET /usospacientes/delete/{id}
    public function delete($id = null)
    {
        if ($this->usoPacienteModel->delete($id)) {
            return redirect()->to('/usospacientes')->with('message', 'Registro eliminado correctamente.');
        }
        return redirect()->to('/usospacientes')->with('error', 'Error al eliminar el registro.');
    }
}
