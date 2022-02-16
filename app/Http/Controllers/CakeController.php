<?php

namespace App\Http\Controllers;

use App\Services\CakeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CakeController extends Controller
{
    private $service;

    public function __construct(CakeService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:45',
            'peso' => 'required',
            'valor' => 'required',
            'quantidade' => 'required',
        ]);

        if ($validator->fails()) {
            $array['error'] = 'Envie todos os campos';
            return $array;
        }

        return $this->service->create(
            $request->only(
                'nome',
                'peso',
                'valor',
                'quantidade'
            )
        );
    }

    public function show($id)
    {
        return $this->service->show($id);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'nome' => 'required',
            'peso' => 'required',
            'valor' => 'required',
            'quantidade' => 'required'
        ]);

        if ($validator->fails()) {
            $array['error'] = 'Envie todos os campos';
            return $array;
        }

        return $this->service->update(
            $request->only(
                'id',
                'nome',
                'peso',
                'valor',
                'quantidade'
            )
        );
    }

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            $array['error'] = 'Envie todos os campos';
            return $array;
        }

        return $this->service->destroy($request->id);
    }
}
