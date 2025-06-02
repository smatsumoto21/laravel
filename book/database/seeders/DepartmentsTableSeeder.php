<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 部署のテストデータを作成
        DB::table('departments')->insert([
            'dep_name'=>'admin',
            'authority_employee'=>false,
            'authority_book'=>false,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
        DB::table('departments')->insert([
            'dep_name'=>'general',
            'authority_employee'=>true,
            'authority_book'=>true,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);

    }
}
