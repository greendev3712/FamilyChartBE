<?php

namespace App\Models;

use App\Traits\TenantConnectionResolver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use LaravelEnso\Tables\Traits\TableCache;

class Repository extends \FamilyTree365\LaravelGedcom\Models\Repository
{
    use TableCache, HasFactory, TenantConnectionResolver;
}
