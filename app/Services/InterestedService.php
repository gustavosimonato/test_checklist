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
        
        Mail::send(new SubscribeCakes());

        return ['ok' => 'e-mail enviado com sucesso'];

        /* try {
            DB::beginTransaction();

            $cake = Cake::where('id', $subscribeData['cake_id'])->first();
            if (empty($cake)) {
                return ['error' => 'Bolo não existe ou está indisponível'];
            }

            $interested = new Interested();
            $interested->email = $subscribeData['email'];
            $interested->status = 'active';
            $interested->cakeId = $subscribeData['cake_id'];
            $interested->save();

            DB::commit();
            return new InterestedResource($interested);
        } catch (\Exception $exception) {
            DB::rollback();
            return ['error' => 'erro ao cadastrar e-mail'];
        } */
    }
}
