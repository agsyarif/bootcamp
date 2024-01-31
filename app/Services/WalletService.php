<?php

namespace App\Services;

use App\Models\wallet;
use Illuminate\Support\Str;

class WalletService {

    public function fisrtOrUpdateWallet($user) {
        $randomString = Str::random(3);
        $wallet = wallet::firstOrCreate(
            ['wallet_id' => 'ME' . $user->id . "-" . $randomString],
            [
                'name' => $user->name,
                'password' => $user->password_hash,
                'saldo' => 0
            ]
        );

        return $wallet;
    }

}
