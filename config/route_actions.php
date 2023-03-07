<?php
return [
    'api' => [
        'companies' => [
            'index'     => 'companies.index',
            'projects'  => [
                'index'  => 'companies.projects.index',
                'store'  => 'companies.projects.store',
                'update' => 'companies.projects.update',
                'delete' => 'companies.projects.delete',
            ],
            'employees' => [
                'index'  => 'companies.employees.index',
                'store'  => 'companies.employees.store',
                'update' => 'companies.employees.update',
                'delete' => 'companies.employees.delete',
            ],
        ],
    ],
];
