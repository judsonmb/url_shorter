<?php

namespace App\Models;

use App\Traits\LoggedUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Url extends Model
{
    use HasFactory, LoggedUser;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'original_url',
        'url_key',
        'short_url',
    ];

    /**
     * Get the user that owns the url.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
