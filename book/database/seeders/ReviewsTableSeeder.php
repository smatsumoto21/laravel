<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 部署のテストデータを作成
        DB::table('reviews')->insert([
            'book_id'=>1,
            'employee_id'=>2,
            'comment'=>'おもろい',
            'evaluation'=>5,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
        DB::table('reviews')->insert([
            'book_id'=>1,
            'employee_id'=>3,
            'comment'=>'だめだめ',
            'evaluation'=>1,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
        DB::table('reviews')->insert([
            'book_id'=>2,
            'employee_id'=>4,
            'comment'=>'すばらしい',
            'evaluation'=>4,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
        DB::table('reviews')->insert([
            'book_id'=>3,
            'employee_id'=>4,
            'comment'=>'ICTエンジニア科の教本として使いましたが、自分としてはわかりにくかったように感じます。ただ、挿絵が多いので楽しんで読めました。',
            'evaluation'=>2,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);


    }
}
