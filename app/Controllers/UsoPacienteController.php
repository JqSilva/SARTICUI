<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UsoPacienteModel;
use App\Models\InsumoSalaModel;
use App\Models\PacienteModel;
use App\Models\LoteModel;
use App\Models\InsumoModel;
use App\Models\SalaModel;
use App\Models\TipoRegistroModel;

// Controlador de Uso en Paciente

class UsoPacienteController extends ResourceController
{
    protected $modelName = 'App\Models\UsoPacienteModel';
    protected $format = 'json';

    // GET /usospacientes - Obtener todos los usos en pacientes
    public function index()
    {
        // Obtener todos los usos en pacientes
        $usospacientes = $this->model->findAll();

        // Obtener los insumos, pacientes, sala y tipo de registro
        $insumosalaModel = new InsumoSalaModel();
        $pacienteModel = new PacienteModel();
        $insumoModel = new InsumoModel();
        $salaModel = new SalaModel();
        $tiporegistroModel = new TipoRegistroModel();
        $loteModel = new LoteModel();

        $insumossalas = $insumosalaModel->findAll();
        $pacientes = $pacienteModel->findAll();
        $insumos = $insumoModel->findAll();
        $salas = $salaModel->findAll();
        $tiposregistros = $tiporegistroModel->findAll();
        $lotes = $loteModel->findAll();

        // Convertir estado_insumo a texto
        foreach ($usospacientes as &$usopaciente) {

            // Obtener nombres de insumos, pacientes, sala y tipo de registro
            foreach ($insumossalas as $insumosala) {
                if ($usopaciente['ID_INSUMO_SALA_USO'] == $insumosala['ID_INSUMO_SALA']) {
                    $usopaciente['ID_LOTE_INSUMO_SALA'] = $insumosala['ID_LOTE_INSUMO_SALA']; // ID del lote asociado al insumo en sala

                    // Obtener información del lote relacionado
                    foreach ($lotes as $lote) {
                        if ($lote['ID_LOTE'] == $insumosala['ID_LOTE_INSUMO_SALA']) {
                            $usopaciente['CODIGO_INSUMO'] = $lote['CODIGO_PRODUCTO_LOTE'];
                            $usopaciente['COD_INSUMO'] = $lote['ID_INSUMO_LOTE'];
                            $usopaciente['COSTO_UNITARIO'] = $lote['COSTO_UNITARIO_LOTE']; // Agregamos el costo unitario
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

            foreach ($tiposregistros as $tiporegistro) {
                if ($usopaciente['ID_TIPO_REGISTRO_USO'] == $tiporegistro['ID_TIPO_REGISTRO']) {
                    $usopaciente['TIPO_REGISTRO_NOMBRE'] = $tiporegistro['NOMBRE_TIPO_REGISTRO'];
                    break;
                }
            }
        }

        // Pasar los datos a la vista
        return view('usospacientes/index', [
            'usospacientes' => $usospacientes,
            'insumossalas' => $insumossalas,
            'pacientes' => $pacientes,
            'tiposregistros' => $tiposregistros
        ]);
    }

    // GET /usospacientes/create - Mostrar el formulario para crear un insumo
    public function create()
    {
        // Obtener datos de las tablas Lote, Sala e Insumo
        $insumosalaModel = new InsumoSalaModel();
        $pacienteModel = new PacienteModel();
        $insumoModel = new InsumoModel();
        $loteModel = new LoteModel();
        $salaModel = new SalaModel();
        $tiporegistroModel = new TipoRegistroModel();

        $insumossalas = $insumosalaModel->findAll();
        $pacientes = $pacienteModel->findAll();
        $insumos = $insumoModel->findAll();
        $lotes = $loteModel->findAll();
        $salas = $salaModel->findAll();
        $tiposregistros = $tiporegistroModel->findAll();

        // Asignar nombre del insumo a cada insumo_sala a través del lote
        foreach ($insumossalas as &$insumosala) {
            // Buscar el lote correspondiente
            foreach ($lotes as $lote) {
                if ($lote['ID_LOTE'] == $insumosala['ID_LOTE_INSUMO_SALA']) {
                    // Buscar el insumo relacionado con el lote
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

        // Pasar los datos a la vista
        return view('usospacientes/create', [
            'insumossalas' => $insumossalas,
            'lotes' => $lotes,
            'pacientes' => $pacientes,
            'insumos' => $insumos,
            'salas' => $salas,
            'tiposregistros' => $tiposregistros
        ]);
    }

    // POST /usospacientes - Crear un nuevo insumo
    public function store()
    {
        $data = $this->request->getPost();

        // Obtener la cantidad disponible de insumo en sala
        $insumoSalaModel = new InsumoSalaModel();
        $insumoSala = $insumoSalaModel->find($data['ID_INSUMO_SALA_USO']); // Suponiendo que tienes un campo 'ID_INSUMO_SALA_USO'

        if (!$insumoSala) {
            return redirect()->to(base_url('/usospacientes'))->with('error', 'El insumo seleccionado no existe en sala.');
        }

        // Comparar la cantidad utilizada con la cantidad disponible en insumo sala
        $cantidadDisponible = (int) $insumoSala['CANTIDAD_INSUMO_SALA'];
        $cantidadUtilizada = (int) $data['CANTIDAD_UTILIZADA_USO'];

        if ($cantidadUtilizada > $cantidadDisponible) {
            return redirect()->to(base_url('/usospacientes'))->with('error', 'Cantidad Utilizada supera la Disponible.');
        }

        // Si la cantidad es válida, registrar el uso en paciente
        $this->model->insert($data);

        // Actualizar la cantidad disponible en InsumoSala (restar la cantidad utilizada)
        $newCantidadDisponible = $cantidadDisponible - $cantidadUtilizada;
        $insumoSalaModel->update($data['ID_INSUMO_SALA_USO'], [
            'CANTIDAD_INSUMO_SALA' => $newCantidadDisponible
        ]);

        // No se debe agregar de nuevo al stock disponible, ya que se está usando en paciente

        return redirect()->to(base_url('/usospacientes'))->with('message', 'Consumo Registrado Correctamente.');
    }

    // GET /usospacientes/edit/{id} - Mostrar el formulario para editar un insumo
    public function edit($id = null)
    {
        $usopaciente = $this->model->find($id);

        if ($usopaciente) {
            $insumosalaModel = new InsumoSalaModel();
            $pacienteModel = new PacienteModel();
            $insumoModel = new InsumoModel();
            $loteModel = new LoteModel();
            $salaModel = new SalaModel();
            $tiporegistroModel = new TipoRegistroModel();

            $insumossalas = $insumosalaModel->findAll();
            $pacientes = $pacienteModel->findAll();
            $insumos = $insumoModel->findAll();
            $lotes = $loteModel->findAll();
            $salas = $salaModel->findAll();
            $tiposregistros = $tiporegistroModel->findAll();

            // Asignar nombre del insumo a cada insumo_sala a través del lote
            foreach ($insumossalas as &$insumosala) {
                // Buscar el lote correspondiente
                foreach ($lotes as $lote) {
                    if ($lote['ID_LOTE'] == $insumosala['ID_LOTE_INSUMO_SALA']) {
                        // Buscar el insumo relacionado con el lote
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

            // Pasar los datos a la vista
            return view('usospacientes/edit', [
                'usopaciente' => $usopaciente,
                'insumossalas' => $insumossalas,
                'lotes' => $lotes,
                'pacientes' => $pacientes,
                'insumos' => $insumos,
                'salas' => $salas,
                'tiposregistros' => $tiposregistros
            ]);
        }
        return redirect()->to('/usospacientes')->with('error', 'No se encontró el insumo con ID: ' . $id);
    }

    // POST /usospacientes/update/{id} - Actualizar un insumo
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->model->find($id)) {
            if ($this->model->update($id, $data)) {
                $response = [
                    'status' => 200,
                    'message' => 'Salida de Bodega actualizada exitosamente'
                ];
                return redirect()->to('/usospacientes')->with('message', $response['message']);
            }
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/usospacientes')->with('error', 'No se encontró la salida con ID: ' . $id);
    }

    // DELETE /usospacientes/{id} - Eliminar un insumo
    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            if ($this->model->delete($id)) {
                $response = [
                    'status' => 200,
                    'message' => 'Salida de Bodega eliminada exitosamente'
                ];
                return redirect()->to('/usospacientes')->with('message', $response['message']);
            }
            return redirect()->to('/usospacientes')->with('error', 'Error al eliminar la salida');
        }

        return redirect()->to('/usospacientes')->with('error', 'No se encontró la salida con ID: ' . $id);
    }
}
