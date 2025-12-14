<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tasklist extends Model
{
    protected $fillable = [
        'task',
        'deadline',
        'waktu',
        'user_id',
        'category_id',
        'status_id'
    ];
    public function User ():BelongsTo {
        return $this -> belongsTo(User::class);
    }

    public function Status():HasMany{
        return $this -> hasMany(Status::class);
    }

    public function Category():HasMany{
        return $this->hasMany(Category::class);
    }

}
