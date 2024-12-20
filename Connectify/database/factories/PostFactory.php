<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=>User::factory(),
            'description'=>fake()->sentence(),
            'location'=>fake()->city(),
            'allow_comments'=>fake()->boolean(),
            'hide_like_count'=>fake()->boolean(),
            'type'=>'post',
        ];
    }

    function configure():static
    {
        return $this->afterCreating(function(Post $post){
            if($post->type==='post')
            {
                //Media::factory->post()->create(['mediable_type'=>get_class($post), 'mediable_id'=>$post->id]);
            }
            else
            {
                //Media::factory->img()->create(['mediable_type'=>get_class($post), 'mediable_id'=>$post->id]);
            }
        });
    }
}
