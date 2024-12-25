<?php

namespace App\Http\Controllers;

use Database\Factories\BrandFactory;
use Database\Factories\CategoryFactory;
use Database\Factories\ProductFactory;
use Faker\Provider\File;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ThumnailControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_generated_success():void
    {
        $size = '500x500';
        $method = 'resize';
        $storage = Storage::disk('images');

        config()->set('thumbnail', ['allowed_sizes' => [$size]]);

        $product = ProductFactory::new()->create();

        $response = $this->get($product->makeThumbnail($size, $method));
        $response->assertOk();
        $storage->assertExists(
            "products/$method/$size/" . File::basename($product->thumbnail)
        );
    }
}
