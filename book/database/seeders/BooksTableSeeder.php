<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 部署のテストデータを作成
        DB::table('books')->insert([
            'title'=>'もも組',
            'author'=>'ももさん',
            'publisher'=>'ピーチ社',
            'isbn'=>7468135713549,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
        DB::table('books')->insert([
            'title'=>'PHP入門',
            'author'=>'ぴーたろう',
            'publisher'=>'ポスター社',
            'isbn'=>1357135051357,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
        DB::table('books')->insert([
            'title'=>'はじめてのJava',
            'author'=>'ジャクソン',
            'publisher'=>'インプレス社',
            'isbn'=>1354627216056,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
        DB::table('books')->insert([
            'title'=>'Linux超解説',
            'author'=>'りんたろう',
            'publisher'=>'ふうりん社',
            'isbn'=>9135475094576,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);

    }
}
