<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NavMenu extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $items = [
            [
                'title' => 'Administración',
                'icon' => 'settings',
                'active' => false,
                'items' => [
                    [
                        'title' => 'Base de Datos', 'icon' => 'backup', 'route' => ['name' => 'base_datos'],
                        'permissions' => [
                            'make_salva_base_datos'
                        ]
                    ],
                    [
                        'title' => 'Trazas', 'icon' => 'history', 'route' => ['name' => 'trazas'],
                        'permissions' => [
                            'read_traza'
                        ]
                    ],
                    [
                        'title' => 'Usuarios', 'icon' => 'group', 'route' => ['name' => 'usuarios'],
                        'permissions' => [
                            'create_usuario',
                            'read_usuario',
                            'update_usuario',
                            'delete_usuario',
                        ]
                    ],
                    [
                        'title' => 'Roles', 'icon' => 'group', 'route' => ['name' => 'roles'],
                        'permissions' => [
                            'create_rol',
                            'read_rol',
                            'update_rol',
                            'delete_rol',
                        ]
                    ]
                ]
            ],

            [
                'title' => 'Datos Generales',
                'icon' => 'work',
                'active' => false,
                'items' => [
                    [
                        'title' => 'Provincias', 'icon' => 'view_list', 'route' => ['name' => 'provincias'],
                        'permissions' => [
                            'create_provincia',
                            'read_provincia',
                            'update_provincia',
                            'delete_provincia',
                        ]
                    ],
                    [
                        'title' => 'Entidades', 'icon' => 'view_list', 'route' => ['name' => 'entidades'],
                        'permissions' => [
                            'create_entidad',
                            'read_entidad',
                            'update_entidad',
                            'delete_entidad',
                        ]
                    ],
                    [
                        'title' => 'Centrales Eléctricas', 'icon' => 'view_list', 'route' => ['name' => 'centrales_electricas'],
                        'permissions' => [
                            'create_central',
                            'read_central',
                            'update_central',
                            'delete_central',
                        ]
                    ],
                    [
                        'title' => 'Baterías', 'icon' => 'view_list', 'route' => ['name' => 'baterias'],
                        'permissions' => [
                            'create_bateria',
                            'read_bateria',
                            'update_bateria',
                            'delete_bateria',
                        ]
                    ],
                    [
                        'title' => 'Grupos', 'icon' => 'view_list', 'route' => ['name' => 'grupos'],
                        'permissions' => [
                            'create_grupo',
                            'read_grupo',
                            'update_grupo',
                            'delete_grupo',
                        ]
                    ],
                    [
                        'title' => 'Proveedores', 'icon' => 'view_list', 'route' => ['name' => 'proveedores'],
                        'permissions' => [
                            'create_proveedor',
                            'read_proveedor',
                            'update_proveedor',
                            'delete_proveedor',
                        ]
                    ],
                    [
                        'title' => 'Brigadas', 'icon' => 'view_list', 'route' => ['name' => 'brigadas'],
                        'permissions' => [
                            'create_brigada',
                            'read_brigada',
                            'update_brigada',
                            'delete_brigada',
                        ]
                    ],
                    [
                        'title' => 'Mantenedores Externos', 'icon' => 'view_list', 'route' => ['name' => 'mantenedores_externos'],
                        'permissions' => [
                            'create_mantenedor_externo',
                            'read_mantenedor_externo',
                            'update_mantenedor_externo',
                            'delete_mantenedor_externo',
                        ]
                    ],
                    [
                        'title' => 'Operadores', 'icon' => 'view_list', 'route' => ['name' => 'operadores'],
                        'permissions' => [
                            'create_operador',
                            'read_operador',
                            'update_operador',
                            'delete_operador',
                        ]
                    ]
                ]
            ],

            [
                'title' => 'Combustible',
                'icon' => 'flash_on',
                'active' => false,
                'items' => [
                    [
                        'title' => 'Materia de Servicios', 'icon' => 'calendar_view_day', 'route' => ['name' => 'datos_generales'],
                        'permissions' => [
                            'create_dato_general',
                            'read_dato_general',
                            'update_dato_general',
                            'delete_dato_general',
                        ]
                    ],
                    [
                        'title' => 'Generaciones', 'icon' => 'calendar_view_day', 'route' => ['name' => 'generaciones'],
                        'permissions' => [
                            'create_generacion',
                            'read_generacion',
                            'update_generacion',
                            'delete_generacion',
                        ]
                    ],
                    [
                        'title' => 'Pailas', 'icon' => 'calendar_view_day', 'route' => ['name' => 'pailas'],
                        'permissions' => [
                            'create_paila',
                            'read_paila',
                            'update_paila',
                            'delete_paila',
                        ]
                    ],
                    [
                        'title' => 'Coberturas Combustibles', 'icon' => 'calendar_view_day', 'route' => ['name' => 'coberturas_combustibles'],
                        'permissions' => [
                            'create_cobertura_combustible',
                            'read_cobertura_combustible',
                            'update_cobertura_combustible',
                            'delete_cobertura_combustible',
                        ]
                    ]
                ]
            ],

            [
                'title' => 'Producción',
                'icon' => 'business_center',
                'active' => false,
                'items' => [
                    [
                        'title' => 'Eventos Diarios', 'icon' => 'menu', 'route' => ['name' => 'eventos_diarios'],
                        'permissions' => [
                            'create_evento_diario',
                            'read_evento_diario',
                            'update_evento_diario',
                            'delete_evento_diario',
                        ]
                    ],
                    [
                        'title' => 'Planes', 'icon' => 'menu', 'route' => ['name' => 'planes'],
                        'permissions' => [
                            'create_plan',
                            'read_plan',
                            'update_plan',
                            'delete_plan',
                        ]
                    ],
                    [
                        'title' => 'Disponibilidades', 'icon' => 'menu', 'route' => ['name' => 'disponibilidades'],
                        'permissions' => [
                            'create_disponibilidad',
                            'read_disponibilidad',
                            'update_disponibilidad',
                            'delete_disponibilidad',
                        ]
                    ],
                    [
                        'title' => 'Mantenimientos', 'icon' => 'menu', 'route' => ['name' => 'mantenimientos'],
                        'permissions' => [
                            'create_mantenimiento',
                            'read_mantenimiento',
                            'update_mantenimiento',
                            'delete_mantenimiento',
                        ]
                    ],
                    [
                        'title' => 'Hechos Extraordinarios', 'icon' => 'menu', 'route' => ['name' => 'hechos_extraordinarios'],
                        'permissions' => [
                            'create_hecho_extraordinario',
                            'read_hecho_extraordinario',
                            'update_hecho_extraordinario',
                            'delete_hecho_extraordinario',
                        ]
                    ]
                ]
            ],

            [
                'title' => 'Reportes',
                'icon' => 'business_center',
                'active' => false,
                'items' => [
                    [
                        'title' => 'Disponibilidad', 'icon' => 'menu', 'route' => ['name' => '5'],
                        'permissions' => [
                            'read_reporte',
                        ]
                    ],
                    [
                        'title' => 'Existencia de Lubricantes', 'icon' => 'menu', 'route' => ['name' => '8'],
                        'permissions' => [
                            'read_reporte',
                        ]
                    ],
                    [
                        'title' => 'Existencia de Refrigerantes', 'icon' => 'menu', 'route' => ['name' => '9'],
                        'permissions' => [
                            'read_reporte',
                        ]
                    ]
                ]
            ]
        ];
        return $this->filter($items);
    }

    public function filter($items)
    {
        $response = [];
        foreach ($items as $dropdown) {
            $children = $this->allowedChilds($dropdown['items']);
            if ($children) {
                $dropdown['items'] = $children;
                $response[] = $dropdown;
            }
        }
        return $response;
    }

    public function allowedChilds($toFilter)
    {
        $response = [];
        $permissions = Auth::user()->getAllPermissions()->pluck('name')->all();
        foreach ($toFilter as $key => $child) {
            foreach ($child['permissions'] as $key => $permission) {
                if (in_array($permission, $permissions)) {
                    $response[] = $child;
                    break;
                }
            }
        }
        return $response;
    }
}
