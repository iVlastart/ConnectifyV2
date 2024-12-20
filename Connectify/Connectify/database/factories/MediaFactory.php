<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $url = $this->getUrl('post');
        $mime = $this->getMimeType($url);
        return [
            'url'=>$url,
            'mime'=>$mime,
            'mediable_id'=> Post::factory(),
            'mediable_type'=> function(array $attributes){
                return Post::find($attributes['mediable_id'])->getMorphClass();
            }
        ];
    }

    function getUrl($type='post'):string
    {
        $urls=['https://images.unsplash.com/photo-1720048171230-c60d162f93a0?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwxfHx8ZW58MHx8fHx8',
                "http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4"];
        return $this->faker->randomElement($urls);
    }
    function getMimeType($url)
    {
        if(str()->contains($url, ignoreCase: 'gtv-videos-bucket'))
        {
            return "video";
        }
        elseif(str()->contains($url, 'images.unsplash.com'))
        {
            return "img";
        }
    }
}
