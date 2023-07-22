<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Feed extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subtitle', 'path', 'feed_id'];

    public function entries(): HasMany {
        return $this->hasMany(Entry::class);
    }
}
