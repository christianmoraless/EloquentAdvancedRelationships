<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\Group::factory(3)->create();
        \App\Models\Level::factory()->create(['name' => 'Oro']);
        \App\Models\Level::factory()->create(['name' => 'Plata']);
        \App\Models\Level::factory()->create(['name' => 'Bronce']);

        \App\Models\User::factory(5)->create()->each( function ($user) {
            $profile = $user->profile()->save(\App\Models\Profile::factory()->make());
            $profile->location()->save(\App\Models\Location::factory()->make());
            $user->groups()->attach($this->array(rand(1,3)));
            $user->image()->save(\App\Models\Image::factory()->make([
                'url' => 'https://lorempixel.com/90/90'
            ]));
        });

        \App\Models\Category::factory(4)->create();
        \App\Models\Tag::factory(12)->create();

        \App\Models\Post::factory(12)->create()->each(function ($post) {
            $post->image()->save(\App\Models\Image::factory()->make());
            $post->tags()->attach($this->array(rand(1,12)));
            $number_comments = rand(1,6);
            for ($i=0; $i < $number_comments; $i++) { 
                $post->comments()->save(\App\Models\Comment::factory()->make());
            }
        });

        \App\Models\Video::factory(12)->create()->each(function ($video) {
            $video->image()->save(\App\Models\Image::factory()->make());
            $video->tags()->attach($this->array(rand(1,12)));
            $number_comments = rand(1,6);
            for ($i=0; $i < $number_comments; $i++) { 
                $video->comments()->save(\App\Models\Comment::factory()->make());
            }
        });


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([-
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }

    public function array($max){

        $values = [];

        for($i = 0 ; $i < $max ; $i++){
            $values[] = $i; 
        }

        return $values;

    }
}
