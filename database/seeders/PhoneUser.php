<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhoneUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('phones')->insert([
            'id' => '28037a79-2bc0-4181-a65f-8f154f6de4kk',
            'user_id' => 'bd34d4bc-4169-41f8-886f-c6989fa52600',
            'phone' => '0877777777888'
        ]);
    }
}
