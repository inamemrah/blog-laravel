<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = ['Hakkımızda', 'Kariyer', 'Vizyonumuz', 'Misyonumuz'];
        $count = 0;
        foreach ($pages as $page) {
            $count++;
            DB::table('pages')->insert([
              'title' => $page,
              'images' => 'https://media-cdn.t24.com.tr/media/stories/2018/01/raw_mesut-ozile-rekor-ucret-premier-ligde-ikinci-oluyor_652696838.jpg',
              'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                            nisi ut aliquip ex ea commodo consequat.
                            Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur.
                            Excepteur sint occaecat cupidatat non proident,
                            sunt in culpa qui officia deserunt mollit anim id est laborum.',
              'slug' => str_slug($page),
              'order' => $count,
              'created_at' => now(),
              'updated_at' => now()
            ]);
        }
    }
}
