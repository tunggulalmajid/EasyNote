<?php

namespace App\Models;

use Illuminate\Console\View\Components\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Status extends Model
{
    protected $table = 'status';
    protected $fillable = [
        'status'
    ];

    public function tasklists(){
        return $this -> hasMany(tasklist::class);
    }

    public function kegiatans(){
        return $this -> hasMany(Kegiatan::class);
    }


}
