<?php

namespace App\Models;

use App\Traits\TenantConnectionResolver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use LaravelEnso\Tables\Traits\TableCache;

class PersonAlia extends \FamilyTree365\LaravelGedcom\Models\PersonAlia
{
    use TableCache, HasFactory, TenantConnectionResolver;
}
