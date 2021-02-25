<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limit = 3;

        if(DB::table('posts')->get()->count() == 0) {

            for ($i = 0; $i < $limit; $i++) {
                Post::create([
                    'author' => 'Author ' . $i ,
                    'title' => 'Title ' . $i,
                    'text' => 'Lorem ipsum dolor ' . $i,
                    'email' => 'email'.$i.'@email.com',
                    'phone' => '12121212',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }

        }
    }
}
