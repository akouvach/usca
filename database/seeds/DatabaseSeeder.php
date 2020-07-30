<?php

use Illuminate\Database\Seeder;
use Illumintate\Support\Facades\Hash;
use App\User;
use App\Article;
use App\Comment;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        factory(User::class)->create([
            'email'=>'akouvach@gmail.com',
            'password'=>Hash::make('mafalda')
        ]);

        factory(Article::class)->times(20)->create();
        factory(Comment::class)->times(10)->create();
    }
}
