<?php

namespace App\Models;

use App\Traits\TenantConnectionResolver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use LaravelEnso\Tables\Traits\TableCache;

class SourceRefEven extends \FamilyTree365\LaravelGedcom\Models\SourceRefEven
{
    use TableCache, HasFactory, TenantConnectionResolver;
}
