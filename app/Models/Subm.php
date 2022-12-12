<?php

namespace App\Models;

use App\Traits\TenantConnectionResolver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use LaravelEnso\Tables\Traits\TableCache;

class Subm extends \FamilyTree365\LaravelGedcom\Models\Subm
{
    use TableCache, HasFactory, TenantConnectionResolver;
}
