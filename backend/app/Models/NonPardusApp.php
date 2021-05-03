<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonPardusApp extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pardusApps()
    {
        return $this->belongsToMany(PardusApp::class);
    }
}
