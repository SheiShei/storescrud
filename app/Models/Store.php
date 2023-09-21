<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory, SoftDeletes;

    protected $hidden = ['deleted_at'];

    protected $fillable = ['name', 'description'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
