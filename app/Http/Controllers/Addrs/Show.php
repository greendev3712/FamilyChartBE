<?php

namespace App\Http\Controllers\Addrs;

use App\Addr;
use Illuminate\Routing\Controller;

class Show extends Controller
{
    public function __invoke(Addr $addr)
    {
        return ['addr' => $addr];
    }
}
