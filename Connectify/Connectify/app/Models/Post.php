<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $guarded=[];
    protected $casts=[
        'hide_like_count'=>'boolean',
        'allow_comments'=>'boolean'
    ];

    /*function media():MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }*/

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
