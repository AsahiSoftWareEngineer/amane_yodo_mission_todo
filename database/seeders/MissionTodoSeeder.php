<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追記

class MIssionTodoseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mission_todos')->insert([
            [
                'id' => 1,
                'task' => '卵を買う',
                'checked' => false,
                'sort_index' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'task' => '銀行に行く',
                'checked' => true,
                'sort_index' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 追加のデータもここに記述可能
        ]);
    }
}
