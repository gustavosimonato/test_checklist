<?php

namespace App\Services;

use App\Http\Resources\InterestedResource;
use App\Mail\SubscribeCakes;
use App\Models\Cake;
use App\Models\Interested;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class InterestedService
{
    public function subscribe(array $subscribeData)
    {
        try {
            DB::beginTransaction();

            $cake = Cake::where('id', $subscribeData['cake_id'])
                ->first();

            if (empty($cake)) {
                return ['error' => 'erro ao cadastrar e-mail'];
            }

            if ($cake->quantity > 0) {
                $mail = new SubscribeCakes(
                    $subscribeData['email'],
                    $cake->name,
                    'disponivel'
                );
            } else {
                $mail = new SubscribeCakes(
                    $subscribeData['email'],
                    $cake->name,
                    'indisponivel'
                );
            }

            $interested = new Interested();
            $interested->name = $subscribeData['nome'];
            $interested->email = $subscribeData['email'];
            $interested->status = 'active';
            $interested->cakeId = $subscribeData['cake_id'];
            $interested->save();

            DB::commit();

            $retorno = new InterestedResource($interested);

            Mail::send($mail);

            return $retorno;
        } catch (\Exception $exception) {
            DB::rollback();
            return ['error' => 'erro ao cadastrar e-mail'];
        }
    }
}
