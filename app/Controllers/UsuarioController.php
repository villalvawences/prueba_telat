<?php

namespace App\Controllers;

use App\Models\Direccion;
use App\Models\TiposUsuarios;
use App\Models\Usuario;

class UsuarioController extends BaseController
{
    protected $helpers = ['form'];

    public function create()
    {
        $tipoUsuarioModelo = new TiposUsuarios();
        $tipos_usuarios = $tipoUsuarioModelo->findAll();

        $data = [
            'tipos_usuarios' => $tipos_usuarios
        ];

        return view('usuarios/create', $data);
    }

    public function generarPassword()
    {
        $caracteresPermitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $longitud = 8;
        $password = '';

        for ($i = 0; $i < $longitud; $i++) {
            $password .= $caracteresPermitidos[rand(0, strlen($caracteresPermitidos) - 1)];
        }

        return $password;
    }

    public function guardar()
    {
        $reglas = [
            'nombre' => [
                'rules' => 'required',
                'errors' => ['required' => 'El {field} es obligatorio'],
            ],
            'apellido' => [
                'rules' => 'required',
                'errors' => ['required' => 'El {field} es obligatorio'],
            ],
            'sexo' => [
                'rules' => 'required',
                'errors' => ['required' => 'El {field} es obligatorio'],
            ],
            'correo_electronico' => [
                'label' => 'correo electrónico',
                'rules' => 'required|valid_email|is_unique[usuarios.correo_electronico]',
                'errors' => [
                    'required' => 'El {field} es obligatorio',
                    'is_unique' => 'El {field} ya está registrado',
                    'valid_email' => 'Ingresa un correo válido',
                ]
            ],
            'telefono' => [
                'label' => 'teléfono',
                'rules' => 'required|numeric|exact_length[10]',
                'errors' => [
                    'required' => 'El {field} es obligatorio',
                    'numeric' => 'El {field} debe ser numérico',
                    'exact_length' => 'El {field} debe tener 10 dígitos',
                ],
            ],
            'codigo_postal' => [
                'label' => 'código postal',
                'rules' => 'required|numeric|exact_length[5]',
                'errors' => [
                    'required' => 'El {field} es obligatorio',
                    'numeric' => 'El {field} debe ser numérico',
                    'exact_length' => 'El {field} debe tener 5 dígitos'
                ],
            ],
            'tipo_usuario' => 'required|is_not_unique[tipos_usuarios.id_tipo_usuario]',
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput();
        } else {
            $nombre = $this->request->getPost('nombre');
            $apellidos = $this->request->getPost('apellido');
            $email = $this->request->getPost('correo_electronico');
            $password = $this->generarPassword();
            $telefono = $this->request->getPost('telefono');
            $sexo = $this->request->getPost('sexo');
            $codigo_postal = $this->request->getPost('codigo_postal');
            $colonia = $this->request->getPost('colonia');
            $municipio = $this->request->getPost('municipio');
            $estado = $this->request->getPost('estado');
            $tipo_usuario = $this->request->getPost('tipo_usuario');
            $fecha_registro = date('Y-m-d H:i:s');

            // Guarda la dirección primero y obtén el ID de la dirección
            $direccionModel = new Direccion();
            $id_direccion = $direccionModel->insert([
                'cp' => $codigo_postal,
                'colonia' => $colonia,
                'municipio' => $municipio,
                'estado' => $estado,
            ]);

            $usuarioModel = new Usuario();
            $usuarioModel->insert([
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'correo_electronico' => $email,
                'telefono' => $telefono,
                'sexo' => $sexo,
                'id_direccion' => $id_direccion,
                'id_tipo_usuario' => $tipo_usuario,
                'password' => $password,
                'status' => '1',
                'fecha_registro' => $fecha_registro
            ]);

            return redirect()->to('/usuarios/create')->with('mensaje', 'Usuario creado correctamente');
        }
    }

    public function editarUsuario($idUsuario)
    {
        $usuarioModelo = new Usuario();
        // Obtener los datos del usuario con el ID proporcionado
        $usuario = $usuarioModelo->select('*')->join('direcciones', 'direcciones.id_direccion = usuarios.id_direccion', 'left')->find($idUsuario);
        // Verificar si el usuario existe
        if ($usuario) {
            $tipoUsuarioModelo = new TiposUsuarios();
            $tipos_usuarios = $tipoUsuarioModelo->findAll();

            $data = [
                'tipos_usuarios' => $tipos_usuarios,
                'usuario' => $usuario
            ];
            // Cargar la vista del formulario de edición con los datos del usuario
            return view('usuarios/edit', $data);
        } else {
            return redirect()->to('/usuarios/reportes')->with('error', 'Usuario no encontrado');
        }
    }

    public function actualizarUsuario($idUsuario)
    {

        $reglas = [
            'nombre' => [
                'rules' => 'required',
                'errors' => ['required' => 'El {field} es obligatorio'],
            ],
            'apellido' => [
                'rules' => 'required',
                'errors' => ['required' => 'El {field} es obligatorio'],
            ],
            'sexo' => [
                'rules' => 'required',
                'errors' => ['required' => 'El {field} es obligatorio'],
            ],
            'correo_electronico' => [
                'label' => 'correo electrónico',
                'rules' => "required|valid_email|is_unique[usuarios.correo_electronico,id_usuario,{$idUsuario}]",

                'errors' => [
                    'required' => 'El {field} es obligatorio',
                    'is_unique' => 'El {field} ya está registrado',
                    'valid_email' => 'Ingresa un correo válido',
                ]
            ],
            'telefono' => [
                'label' => 'teléfono',
                'rules' => 'required|numeric|exact_length[10]',
                'errors' => [
                    'required' => 'El {field} es obligatorio',
                    'numeric' => 'El {field} debe ser numérico',
                    'exact_length' => 'El {field} debe tener 10 dígitos',
                ],
            ],
            'codigo_postal' => [
                'label' => 'código postal',
                'rules' => 'required|numeric|exact_length[5]',
                'errors' => [
                    'required' => 'El {field} es obligatorio',
                    'numeric' => 'El {field} debe ser numérico',
                    'exact_length' => 'El {field} debe tener 5 dígitos'
                ],
            ],
            'tipo_usuario' => 'required|is_not_unique[tipos_usuarios.id_tipo_usuario]',
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput();
        } else {
            $usuarioModelo = new Usuario();
            // Obtener los datos del formulario
            $datosUsuario = [
                'nombre' => $this->request->getPost('nombre'),
                'apellidos' => $this->request->getPost('apellido'),
                'sexo' => $this->request->getPost('sexo'),
                'telefono' => $this->request->getPost('telefono'),
                'correo_electronico' => $this->request->getPost('correo_electronico'),
                'telefono' => $this->request->getPost('telefono'),
                'id_tipo_usuario' => $this->request->getPost('tipo_usuario'),
                'fecha_registro' => date('Y-m-d H:i:s'),
                'password' => $this->generarPassword(),
            ];

            // Actualizar el usuario
            $usuarioModelo->update($idUsuario, $datosUsuario);

            $direccionModelo = new Direccion();
            $datosDireccion = [
                'cp' => $this->request->getPost('codigo_postal'),
                'colonia' => $this->request->getPost('colonia'),
                'municipio' => $this->request->getPost('municipio'),
                'estado' => $this->request->getPost('estado'),
            ];

            // Obtén la ID de la dirección del usuario
            $idDireccion = $usuarioModelo->find($idUsuario)->id_direccion;

            // Actualizar la dirección
            $direccionModelo->update($idDireccion, $datosDireccion);

            return redirect()->to('/usuarios/reportes')->with('mensaje', 'Usuario actualizado correctamente');
        }
    }

    public function eliminarUsuario($id_usuario)
    {
        $usuarioModelo = new Usuario();
        $usuario = $usuarioModelo->find($id_usuario);

        if ($usuario) {
            $usuario->status = '0'; // Cambiar el estado a inactivo
            $usuarioModelo->update($id_usuario, $usuario);

            return $this->response->setJSON(['success' => true]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Usuario no encontrado']);
    }

    public function reportes()
    {
        return view('usuarios/reportes');
    }

    public function cargar_datos_reporte()
    {
        $usuarioModelo = new Usuario();
        $datos = $usuarioModelo->where('status', '1')->findAll();

        echo json_encode($datos);
    }
}
