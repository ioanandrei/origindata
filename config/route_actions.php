<?php
return [
    'api' => [
        'companies' => [
            'index'    => 'companies.index',
            'projects' => [
                'index'  => 'companies.projects.index',
                'store'  => 'companies.projects.store',
                'update' => 'companies.projects.update',
                'delete' => 'companies.projects.delete',
            ],
        ],
    ],
];
