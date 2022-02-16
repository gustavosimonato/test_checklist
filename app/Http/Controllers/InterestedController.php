<?php

namespace App\Http\Controllers;

use App\Services\InterestedService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InterestedController extends Controller
{
    private $service;

    public function __construct(InterestedService $service)
    {
        $this->service = $service;
    }

    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cake_id' => 'required',
            'nome' => 'required',
            'email' => 'email'
        ]);

        if ($validator->fails()) {
            $array['error'] = 'Envie todos os campos';
            return $array;
        }

        return $this->service->subscribe(
            $request->only(
                'cake_id',
                'nome',
                'email'
            )
        );
    }
}
