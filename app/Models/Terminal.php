<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terminal extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    const TYPE_TERMINAL = 'terminal';
    const TYPE_POOL = 'pool';
    const TYPE_CHECKPOINT = 'checkpoint';
    const TYPE = [Terminal::TYPE_TERMINAL, Terminal::TYPE_POOL, Terminal::TYPE_CHECKPOINT];
}
