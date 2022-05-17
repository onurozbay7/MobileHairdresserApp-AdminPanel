<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Workinghours extends Model
{
    protected $guarded = [];

    static function getHours() {
        $data = Workinghours::query()->where('workerId',Auth::id());

        return $data;
    }
}
