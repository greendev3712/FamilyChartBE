<?php

namespace App\Models;

use LaravelEnso\Tables\Traits\TableCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publication extends \FamilyTree365\LaravelGedcom\Models\Publication
{
    use TableCache, HasFactory;
}
