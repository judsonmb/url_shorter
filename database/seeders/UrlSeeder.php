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
        $urlKey = Str::random(5);

        if (! Url::where('url_key', $urlKey)->exists()) {
            \App\Models\Url::factory()->create([
                'original_url' => 'https://www.uol.com.br/esporte/colunas/alicia-klein/2024/01/22/tem-torcedor-que-passara-raiva-o-ano-todo-ja-da-para-saber-quem-sera.htm',
                'url_key' => $urlKey,
                'short_url' => config('app.url').'/api/'.$urlKey
            ]);
        }
    }
}
