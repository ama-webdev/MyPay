<?php

namespace App\Helpers;

use App\Transaction;
use App\Wallet;

class UUIDGenerate
{
    static function accountNumber()
    {
        $number = mt_rand(1000000000000000, 9999999999999999);


        if (Wallet::where('account_number', $number)->exists()) {
            self::accountNumber();
        }

        return $number;
    }


    static function ref_no()
    {
        $number = mt_rand(1000000000000000, 9999999999999999);


        if (Transaction::where('ref_no', $number)->exists()) {
            self::ref_no();
        }

        return $number;
    }



    static function trx_id()
    {
        $number = mt_rand(1000000000000000, 9999999999999999);


        if (Transaction::where('trx_id', $number)->exists()) {
            self::trx_id();
        }

        return $number;
    }
}
