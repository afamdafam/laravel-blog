<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = [ 'id',  'user_id',  'title',  'slug',  'image', 'desc',  'views',  'status',  'publish_date'];

    public function User(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
