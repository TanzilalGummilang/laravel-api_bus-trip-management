<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    const NGY = 'not going yet';
    const OTW = 'on the way';
    const AAD = 'arrive at destination';
    const CANCEL = 'cancel';
    const STATUS = [self::NGY, self::OTW, self::AAD, self::CANCEL];
}
