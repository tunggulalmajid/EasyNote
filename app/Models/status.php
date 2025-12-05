<?php

namespace App\Models;

use Illuminate\Console\View\Components\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class status extends Model
{
    protected $fillable = [
        'status'
    ];

    public function tasklist():BelongsTo{
        return $this -> belongsTo(tasklist::class);
    }
}
