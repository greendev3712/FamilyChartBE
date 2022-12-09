<?php

namespace App\Models;

use App\Traits\TenantConnectionResolver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use LaravelEnso\Tables\Traits\TableCache;

class Place extends \FamilyTree365\LaravelGedcom\Models\Place
{
    use TableCache, HasFactory, TenantConnectionResolver;
}
