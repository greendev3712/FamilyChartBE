<?php

namespace App\Models;

use App\Traits\TenantConnectionResolver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use LaravelEnso\Tables\Traits\TableCache;

class Refn extends \FamilyTree365\LaravelGedcom\Models\Refn
{
    use TableCache, HasFactory, TenantConnectionResolver;
}
