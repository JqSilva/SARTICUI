<?php

namespace App\Controllers;

use App\Models\PrestacionModel;
use App\Models\PrestacionLoteModel;
use App\Models\PrestacionUsuarioModel;
use App\Models\PrestacionEquipoModel;
use App\Models\LoteModel;
use App\Models\UsuarioModel;
use App\Models\EquipoMedicoModel;
use App\Models\ProcedimientoModel;
use App\Models\CondicionPacienteModel;
use App\Models\SalaModel;
use App\Models\PacienteModel;
use App\Models\EstamentoModel;
use CodeIgniter\RESTful\ResourceController;

//Controlador de Prestaciones

class PrestacionController extends ResourceController
{
    protected $modelName = 'App\Models\PrestacionModel';
    protected $format = 'json';

    // GET /prestaciones - Obtener todas las prestaciones con filtro opcional por mes y año
    public function index()
    {
        $prestacionModel = new PrestacionModel();
        $prestaciones = $this->model->findAll();

        // Modelos para obtener información relacionada
        $procedimientoModel = new ProcedimientoModel();
        $condicionpacienteModel = new CondicionPacienteModel();
        $pacienteModel = new PacienteModel();
        $salaModel = new SalaModel();
        $loteModel = new LoteModel();
        $equipoModel = new EquipoMedicoModel();
        $usuarioModel = new UsuarioModel();
        $prestacionloteModel = new PrestacionLoteModel();
        $prestacionequipoModel = new PrestacionEquipoModel();
        $prestacionusuarioModel = new PrestacionUsuarioModel();

        $procedimientos = $procedimientoModel->findAll();
        $condicionespacientes = $condicionpacienteModel->findAll();
        $pacientes = $pacienteModel->findAll();
        $salas = $salaModel->findAll();
        $lotes = $loteModel->findAll();
        $equipos = $equipoModel->findAll();
        $usuarios = $usuarioModel->findAll();

        foreach ($prestaciones as &$prestacion) {
            // Obtener nombres de usuario, sala y estado
            foreach ($procedimientos as $procedimiento) {
                if ($prestacion['ID_PROCEDIMIENTO_PRES'] == $procedimiento['ID_PROCEDIMIENTO']) {
                    $prestacion['PROCEDIMIENTO_NOMBRE'] = $procedimiento['NOMBRE_PROCEDIMIENTO'];
                    break;
                }
            }

            foreach ($condicionespacientes as $condicionpaciente) {
                if ($prestacion['ID_CONDICION_PACIENTE_PRES'] == $condicionpaciente['ID_CONDICION_PACIENTE']) {
                    $prestacion['CONDICION_PACIENTE_NOMBRE'] = $condicionpaciente['NOMBRE_CONDICION_PACIENTE'];
                    break;
                }
            }

            foreach ($pacientes as $paciente) {
                if ($prestacion['ID_PACIENTE_PRES'] == $paciente['ID_PACIENTE']) {
                    $prestacion['PACIENTE_NOMBRE'] = $paciente['NOMBRE_PACIENTE'] . ' ' . $paciente['APATERNO_PACIENTE'];
                    break;
                }
            }

            foreach ($salas as $sala) {
                if ($prestacion['ID_SALA_PRES'] == $sala['ID_SALA']) {
                    $prestacion['SALA_NOMBRE'] = $sala['NOMBRE_SALA'];
                    break;
                }
            }

            // Obtener detalles de la prestacion
            $prestacioneslotes = $prestacionloteModel->where('ID_PRESTACION_LT', $prestacion['ID_PRESTACION'])->findAll();
            $prestacionesequipos = $prestacionequipoModel->where('ID_PRESTACION_EQU', $prestacion['ID_PRESTACION'])->findAll();
            $prestacionesusuarios = $prestacionusuarioModel->where('ID_PRESTACION_USU', $prestacion['ID_PRESTACION'])->findAll();

            foreach ($prestacionesequipos as &$prestacionequipo) {
                $equipo = $equipoModel->find($prestacionequipo['ID_EQUIPO_MEDICO_PRE']);
                $prestacionequipo['NOMBRE_EQUIPO'] = $equipo ? $equipo['NOMBRE_EQUIPO'] : 'Desconocido';
            }
            foreach ($prestacionesusuarios as &$prestacionusuario) {
                $usuario = $usuarioModel->find($prestacionusuario['ID_USUARIO_USU']);
                $prestacionusuario['NOMBRE_USUARIO'] = $usuario ? $usuario['NOMBRE_USUARIO'] : 'Desconocido';
            }

            $prestacion['PRESTACIONES_LOTES'] = $prestacioneslotes;
            $prestacion['PRESTACIONES_EQUIPOS'] = $prestacionesequipos;
            $prestacion['PRESTACIONES_USUARIOS'] = $prestacionesusuarios;
        }

        // Pasar los datos a la vista
        return view('prestaciones/index', [
            'prestaciones' => $prestaciones,
            'procedimientos' => $procedimientos,
            'condicionespacientes' => $condicionespacientes,
            'pacientes' => $pacientes,
            'salas' => $salas
        ]);
    }

    // GET /prestaciones/create - Mostrar el formulario para crear una prestacion
    public function create()
    {
        // Obtener datos de las tablas procedimiento, condicion paciente, paciente y sala
        $procedimientoModel = new ProcedimientoModel();
        $condicionpacienteModel = new CondicionPacienteModel();
        $pacienteModel = new PacienteModel();
        $salaModel = new SalaModel();
        $loteModel = new LoteModel();
        $equipoModel = new EquipoMedicoModel();
        $usuarioModel = new UsuarioModel();

        $procedimientos = $procedimientoModel->findAll();
        $condicionespacientes = $condicionpacienteModel->findAll();
        $pacientes = $pacienteModel->findAll();
        $salas = $salaModel->findAll();
        $lotes = $loteModel->findAll();
        $equipos = $equipoModel->findAll();
        $usuarios = $usuarioModel->findAll();

        // Pasar los datos a la vista
        return view('prestaciones/create', [
            'procedimientos' => $procedimientos,
            'condicionespacientes' => $condicionespacientes,
            'pacientes' => $pacientes,
            'salas' => $salas,
            'lotes' => $lotes,
            'equipos' => $equipos,
            'usuarios' => $usuarios
        ]);
    }

    // POST /prestaciones - Crear una nueva prestacion
    public function store()
    {
        // Obtener los datos del formulario
        $data = $this->request->getPost();

        // Preparar los datos para la prestación
        $prestacionData = [
            'FECHA_PRESTACION' => $data['FECHA_PRESTACION'],
            'HORA_INICIO' => $data['HORA_INICIO'],
            'HORA_FIN' => $data['HORA_FIN'],
            'COSTO_TOTAL_PRESTACION' => 0,
            'COSTO_USUARIO' => 0,
            'ID_PROCEDIMIENTO_PRES' => $data['ID_PROCEDIMIENTO_PRES'],
            'ID_CONDICION_PACIENTE_PRES' => $data['ID_CONDICION_PACIENTE_PRES'],
            'ID_PACIENTE_PRES' => $data['ID_PACIENTE_PRES'],
            'ID_SALA_PRES' => $data['ID_SALA_PRES']
        ];

        try {
            // Intentar insertar y capturar cualquier error
            $inserted = $this->model->insert($prestacionData);

            if ($inserted) {
                $prestacionId = $this->model->getInsertID();

                // Si la inserción fue exitosa, mostrar los datos insertados
                var_dump("Inserción exitosa. ID: " . $prestacionId);

                // Continuar con el resto de las inserciones...
                $prestacionLoteModel = new PrestacionLoteModel();
                $prestacionEquipoModel = new PrestacionEquipoModel();
                $prestacionUsuarioModel = new PrestacionUsuarioModel();

                // Manejar lotes
                if (isset($data['lotes'])) {
                    foreach ($data['lotes'] as $lote) {
                        $prestacionLoteModel->insert([
                            'ID_PRESTACION_LT' => $prestacionId,
                            'ID_LOTE_LT' => $lote['ID_LOTE_LT'],
                            'CANTIDAD_UTILIZADA' => $lote['CANTIDAD_UTILIZADA']
                        ]);
                    }
                }

                // Manejar equipos
                if (isset($data['equipos'])) {
                    foreach ($data['equipos'] as $equipo) {
                        $prestacionEquipoModel->insert([
                            'ID_PRESTACION_EQU' => $prestacionId,
                            'ID_EQUIPO_MEDICO_PRE' => $equipo['ID_EQUIPO_MEDICO_PRE']
                        ]);
                    }
                }

                // Insertar usuarios (los triggers actualizarán el costo automáticamente)
                if (isset($data['usuarios'])) {
                    $prestacionUsuarioModel = new PrestacionUsuarioModel();
                    foreach ($data['usuarios'] as $usuario) {
                        $prestacionUsuarioModel->insert([
                            'ID_PRESTACION_USU' => $prestacionId,
                            'ID_USUARIO_USU' => $usuario['ID_USUARIO_USU']
                        ]);
                    }
                }

                return redirect()->to(base_url('/prestaciones'))->with('message', 'Prestación creada exitosamente');
            } else {
                return redirect()->back()->withInput()->with('errors', $this->model->errors());
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    // GET /prestaciones/edit/{id} - Mostrar el formulario para editar una prestacion
    public function edit($id = null)
    {
        $prestacion = $this->model->find($id);

        if ($prestacion) {
            // Obtener datos de las tablas Procedimientos, Condición Paciente, Paciente y Sala
            $procedimientoModel = new ProcedimientoModel();
            $condicionpacienteModel = new CondicionPacienteModel();
            $pacienteModel = new PacienteModel();
            $salaModel = new SalaModel();

            $procedimientos = $procedimientoModel->findAll();
            $condicionespacientes = $condicionpacienteModel->findAll();
            $pacientes = $pacienteModel->findAll();
            $salas = $salaModel->findAll();

            // Pasar los datos a la vista
            return view('prestaciones/edit', [
                'prestacion' => $prestacion,
                'procedimientos' => $procedimientos,
                'condicionespacientes' => $condicionespacientes,
                'pacientes' => $pacientes,
                'salas' => $salas
            ]);
        }
        return redirect()->to('/prestaciones')->with('error', 'No se encontró la prestacion con ID: ' . $id);
    }

    // POST /prestaciones/update/{id} - Actualizar una prestacion
    public function update($id = null)
    {
        $data = $this->request->getPost();

        if ($this->model->find($id)) {
            if ($this->model->update($id, $data)) {
                $response = [
                    'status' => 200,
                    'message' => 'Prestacion actualizada exitosamente'
                ];
                return redirect()->to('/prestaciones')->with('message', $response['message']);
            }
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/prestaciones')->with('error', 'No se encontró la prestacion con ID: ' . $id);
    }

    // DELETE /prestaciones/{id} - Eliminar una prestacion
    public function delete($id = null)
    {
        // Verificar si existe la prestación
        $prestacion = $this->model->find($id);

        if ($prestacion) {
            // Eliminar registros en las tablas relacionadas
            $prestacionEquipoModel = new PrestacionEquipoModel();
            $prestacionLoteModel = new PrestacionLoteModel();
            $prestacionUsuarioModel = new PrestacionUsuarioModel();

            // Eliminar registros relacionados en la tabla prestacion_equipo
            $prestacionEquipoModel->where('ID_PRESTACION_EQU', $id)->delete();
            // Eliminar registros relacionados en la tabla prestacion_lote
            $prestacionLoteModel->where('ID_PRESTACION_LT', $id)->delete();

            // Eliminar registros relacionados en la tabla prestacion_usuario
            $prestacionUsuarioModel->where('ID_PRESTACION_USU', $id)->delete();

            // Finalmente eliminar el registro de la tabla prestacion
            if ($this->model->delete($id)) {
                return redirect()->to('/prestaciones')->with('message', 'Prestación eliminada exitosamente');
            } else {
                return redirect()->to('/prestaciones')->with('error', 'No se pudo eliminar la prestación');
            }
        }

        return redirect()->to('/prestaciones')->with('error', 'No se encontró la prestación con ID: ' . $id);
    }

    public function calcularCostoUsuarios($idPrestacion)
    {
        $prestacionUsuarioModel = new PrestacionUsuarioModel();
        $usuarioModel = new UsuarioModel();
        $estamentoModel = new EstamentoModel();

        // Obtener los usuarios de la prestación
        $usuarios = $prestacionUsuarioModel->where('ID_PRESTACION_USU', $idPrestacion)->findAll();

        $costoTotalUsuarios = 0;

        // Recorrer cada usuario y calcular el costo
        foreach ($usuarios as $usuario) {
            $usuarioData = $usuarioModel->find($usuario['ID_USUARIO_USU']);
            if (!$usuarioData) continue;

            // Obtener el estamento del usuario para obtener el sueldo por hora
            $estamento = $estamentoModel->find($usuarioData['ID_ESTAMENTO_USUARIO']);
            if (!$estamento) continue;

            // Calcular las horas trabajadas
            $horasTrabajadas = (strtotime($usuario['HORA_FIN']) - strtotime($usuario['HORA_INICIO'])) / 3600;

            // Si las horas trabajadas son válidas, calcular el costo
            if ($horasTrabajadas > 0) {
                $sueldoPorHora = $estamento['SUELDO_HORA'];
                $costoTotalUsuarios += $horasTrabajadas * $sueldoPorHora;
            }
        }

        // Actualizar el costo total de usuarios en la prestación
        $prestacionModel = new PrestacionModel();
        $prestacion = $prestacionModel->find($idPrestacion);

        if ($prestacion) {
            $prestacionModel->update($idPrestacion, [
                'COSTO_USUARIO' => $costoTotalUsuarios
            ]);
        }

        return $costoTotalUsuarios;
    }

}