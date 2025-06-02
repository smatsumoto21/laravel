<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 社員のテストデータを作成
        DB::table('employees')->insert([
            'login_id'=>'ippan',
            'pass'=>'ppp',
            'department_id'=>1,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
        DB::table('employees')->insert([
            'login_id'=>'soumu',
            'pass'=>'sss',
            'department_id'=>2,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
        DB::table('employees')->insert([
            'login_id'=>'ippan2',
            'pass'=>'p22',
            'department_id'=>1,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
        DB::table('employees')->insert([
            'login_id'=>'soumu2',
            'pass'=>'s22',
            'department_id'=>2,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);

    }
}
