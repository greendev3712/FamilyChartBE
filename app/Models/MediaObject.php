<?php

namespace App\Models;

use App\Traits\TenantConnectionResolver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use LaravelEnso\Tables\Traits\TableCache;

class MediaObject extends \FamilyTree365\LaravelGedcom\Models\MediaObject
{
    use TableCache, HasFactory, TenantConnectionResolver;
}
