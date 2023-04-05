<?php

namespace App\Services;

use App\Http\Resources\CakeResource;
use App\Models\Cake;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
// use NumberFormatter;

class CakeService
{
    public function index()
    {
        return new CakeResource(Cake::all());
    }

    public function create(array $createData)
    {
        try {
            DB::beginTransaction();

            // $formatador = new NumberFormatter('de_DE', NumberFormatter::DECIMAL);

            // $peso = $formatador->parse((int) $createData['peso']);
            // $valor = $formatador->parse((int) $createData['valor']);

            $newCake = new Cake();
            $newCake->name = $createData['nome'];
            $newCake->weight = $createData['peso'];
            $newCake->value = $createData['valor'];
            $newCake->quantity = $createData['quantidade'];
            $newCake->save();

            DB::commit();

            return new CakeResource($newCake);
        } catch (\Exception $exception) {
            DB::rollback();
            return ['error' => 'erro ao cadastrar bolo'];
        }
    }

    public function show(int $id)
    {
        try {
            return new CakeResource(Cake::where('id', $id)->get());
        } catch (\Exception $exception) {
            return ['error' => 'Não foi possivel selecionar o bolo'];
        }
    }

    public function update(array $updateData)
    {
        try {
            DB::beginTransaction();

            $formatador = new NumberFormatter('de_DE', NumberFormatter::DECIMAL);

            $peso = $formatador->parse((int) $updateData['peso']);
            $valor = $formatador->parse((int) $updateData['valor']);

            $updateCake = Cake::where('id', $updateData['id'])->first();
            $updateCake->name = $updateData['nome'];
            $updateCake->eight = $peso;
            $updateCake->value = $valor;
            $updateCake->quantity = $updateData['quantidade'];
            $updateCake->save();

            DB::commit();

            return new CakeResource($updateCake);
        } catch (\Exception $exception) {
            DB::rollback();
            return ['error' => 'erro ao atualizar bolo'];
        }
    }

    public function destroy(int $id)
    {
        try {
            DB::beginTransaction();

            $cake = Cake::where('id', $id)->first();
            $cake->delete();

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            return ['error' => 'erro ao excluir bolo'];
        }
    }
}
