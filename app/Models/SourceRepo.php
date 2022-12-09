<?php

namespace App\Models;

use App\Traits\TenantConnectionResolver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use LaravelEnso\Tables\Traits\TableCache;

class SourceRepo extends \FamilyTree365\LaravelGedcom\Models\SourceRepo
{
    use TableCache, HasFactory, TenantConnectionResolver;
}
