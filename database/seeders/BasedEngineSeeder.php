<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BasedEngineSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('based_engines')->truncate();

DB::table('based_engines')->insert([
    ['name' => 'Web', 'cx' => '34eef687ce269487c', 'image' => false, 'video' => false, 'subtitle' => false, 'news' => false, 'position' => 1],
    ['name' => 'Images', 'cx' => '954a56c1e00db57aa', 'image' => true, 'video' => false, 'subtitle' => false, 'news' => false, 'position' => 2],
    ['name' => 'Videos', 'cx' => '530b5e7ca4f8045d4', 'image' => false, 'video' => true, 'subtitle' => false, 'news' => false, 'position' => 3],
    ['name' => 'News', 'cx' => 'b16521454a1884f6a', 'image' => false, 'video' => false, 'subtitle' => false, 'news' => true, 'position' => 4],
    ['name' => 'Torrents', 'cx' => '6ff7034d0894868ee', 'image' => false, 'video' => false, 'subtitle' => false, 'news' => false, 'position' => 5],
    ['name' => 'Subtitles', 'cx' => '93314d2add702dbab', 'image' => false, 'video' => false, 'subtitle' => true, 'news' => false, 'position' => 6],
]);
    }
}
