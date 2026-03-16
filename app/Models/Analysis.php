<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Analysis extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'type_analyse',
        'resultats',
    ];

    protected $casts = [
        'resultats' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
