<?php

namespace App\Http\Controllers\Personasso;

use App\Http\Requests\ValidatePersonAssoRequest;
use App\PersonAsso;
use Illuminate\Routing\Controller;

class Store extends Controller
{
    public function __invoke(ValidatePersonAssoRequest $request, PersonAsso $personAsso)
    {
        $personAsso->fill($request->validated())->save();

        return [
            'message' => __('The person asso was successfully created'),
            'redirect' => 'personasso.edit',
            'param' => ['personAsso' => $personAsso->id],
        ];
    }
}
