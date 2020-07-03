<?php

namespace App\Http\Controllers\Places;

use App\Place;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LaravelEnso\Select\Traits\OptionsBuilder;

class Options extends Controller
{
    use OptionsBuilder;

    protected string $model = Place::class;

    //protected $queryAttributes = ['name'];

    //public function query(Request $request)
    //{
    //    return Place::query();
    //}
}
