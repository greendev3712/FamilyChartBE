<?php

namespace App\Models;

use App\Traits\TenantConnectionResolver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use LaravelEnso\Tables\Traits\TableCache;

class SourceData extends \FamilyTree365\LaravelGedcom\Models\SourceData
{
    use TableCache, HasFactory, TenantConnectionResolver;
}
