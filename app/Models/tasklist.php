<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class tasklist extends Model
{
    protected $fillable = [
        'task',
        'deadline',
        'waktu',
        'user_id',
        'category_id',
        'status_id'
    ];
    public function users ():BelongsTo {
        return $this -> belongsTo(User::class);
    }
}
