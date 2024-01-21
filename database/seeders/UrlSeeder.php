<?php

namespace Database\Seeders;

use App\Models\Url;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i<100; $i++) {
            $urlKey = Str::random(5);

            if (! Url::where('url_key', $urlKey)->exists()) {
                \App\Models\Url::factory()->create([
                    'url_key' => $urlKey,
                    'short_url' => config('app.url').'/'.$urlKey
                ]);
            }
        }
    }
}
