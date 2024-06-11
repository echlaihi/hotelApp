<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $img = UploadedFile::fake()->image("imge.jpg", 500, 400)->size(100);
        $img = Storage::disk("images")->put('', $img);
        return [
            "room_id" => 1,
            "name" => $img,
            "is_initial" => random_int(0, 1),
        ];
    }
}
