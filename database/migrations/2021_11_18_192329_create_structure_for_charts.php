<?php

use LaravelEnso\Migrator\Database\Migration;

class CreateStructureForCharts extends Migration
{
    protected array $permissions = [

    ];

    protected array $menu = [
        'name' => 'Decendent Chart', 'icon' => 'users', 'route' => 'tree.show', 'order_index' => 999, 'has_children' => false,
    ];

    protected ?string $parentMenu = 'Trees';
}
