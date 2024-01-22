<?php

namespace App\Services;

use App\Models\Url;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class UrlService {

    public function __construct(
        public readonly Url $model,
    )
    {
    }

    public function getUserUrls(int $userId): Collection
    {
        return $this->model->where('user_id', $userId)->orderByDesc('id')->get();
    }

    public function createUrl(array $data): Url
    {
        $urlKey = Str::random(5);
        $data['url_key'] = $urlKey;
        $data['short_url'] = $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/api/'.$urlKey;

        return $this->model->create($data);
    }

    public function getUrlByUrlKey(string $urlKey)
    {
        return $this->model->where('url_key', $urlKey)->firstOrFail()->original_url;
    }
}