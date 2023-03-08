<?php
return [
    'api' => [
        'companies' => [
            'index'     => 'companies.index',
            'show'      => 'companies.show',
            'update'    => 'companies.update',
            'delete'    => 'companies.delete',
            'projects'  => [
                'index'  => 'companies.projects.index',
                'show'   => 'companies.projects.show',
                'store'  => 'companies.projects.store',
                'update' => 'companies.projects.update',
                'delete' => 'companies.projects.delete',
            ],
            'employees' => [
                'index'  => 'companies.employees.index',
                'show'   => 'companies.employees.show',
                'store'  => 'companies.employees.store',
                'update' => 'companies.employees.update',
                'delete' => 'companies.employees.delete',
            ],
        ],
    ],
];
