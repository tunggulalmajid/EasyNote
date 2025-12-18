<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tasklist extends Model
{
    protected $table = 'tasklist';
    protected $fillable = [
        'task',
        'deadline',
        'user_id',
        'category_id',
        'status_id',
        'deskripsi'
    ];
    public function user ():BelongsTo {
        return $this -> belongsTo(User::class);
    }

    public function status(){
        return $this -> belongsTo(Status::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

}
