<?php

namespace App\Classes\Sicredi;

use App\Models\Config;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Paulinhoajr\ApiPixSicredi\PixSicredi;

class SicrediConecta
{
    public function conecta()
    {

        $config = Config::first();

        if (Carbon::parse($config->expire) < Carbon::now()) {

            $pix = new PixSicredi();
            $accessToken = $pix->accessToken();

            if ($accessToken['httpcode'] !== 200){
                dd($accessToken);
            }

            $expire = Carbon::now()
                ->addSeconds($accessToken['expires_in'])
                ->format('Y-m-d H:i:s');

            try {
                DB::beginTransaction();
                $config->token = $accessToken['access_token'];
                $config->expire = $expire;
                $config->save();
                DB::commit();
            }catch (\Exception $exception){
                DB::rollBack();
                dd($exception->getMessage());
            }
        }

        return $config->token;
    }
}
