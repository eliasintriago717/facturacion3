<?php

namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table            = 'cliente';
    protected $primaryKey       = 'id_cliente';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['identificacion', 'nombre', 'telefono', 'correo'];

    // Reglas centralizadas en el Modelo
    protected $validationRules = [
        'identificacion' => 'required|validar_cedula|is_unique[cliente.identificacion,id_cliente,{id_cliente}]',
        'nombre'         => 'required|min_length[3]|max_length[100]',
        'telefono'       => 'permit_empty|min_length[7]|max_length[20]',
        'correo'         => 'permit_empty|valid_email|max_length[100]',
    ];

    protected $validationMessages = [
        'identificacion' => [
            'required'       => 'La identificación es obligatoria.',
            'validar_cedula' => 'La cédula ingresada no es válida.',
            'is_unique'      => 'Esta identificación ya se encuentra registrada.',
        ],
        'nombre' => [
            'required'   => 'El nombre del cliente es obligatorio.',
            'min_length' => 'El nombre debe tener al menos 3 caracteres.',
            'max_length' => 'El nombre no puede exceder los 100 caracteres.',
        ],
        'telefono' => [
            'min_length' => 'El teléfono debe tener al menos 7 dígitos.',
            'max_length' => 'El teléfono no puede exceder los 20 caracteres.',
        ],
        'correo' => [
            'valid_email' => 'Por favor, ingrese un correo electrónico válido.',
            'max_length'  => 'El correo electrónico no puede exceder los 100 caracteres.',
        ],
    ];
}