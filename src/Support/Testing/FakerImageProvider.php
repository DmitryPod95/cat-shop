<?php

declare(strict_types=1);

namespace Support\Testing;

use Faker\Provider\Base;
use Illuminate\Support\Facades\Storage;

final class FakerImageProvider extends Base
{
    public function fixturesImage(string $fixturesDir, string $storageDir): string
    {
        $storege = Storage::disk('images');

        if (!$storege->exists($storageDir)) {
            $storege->makeDirectory($storageDir);
        }

        $file = $this->generator->file(
            base_path("tests/Fixtures/images/$fixturesDir"),
            $storege->path($storageDir),
            false
        );

        return '/storage/images/' . trim($storageDir, '/') . '/' . $file;
    }
}
