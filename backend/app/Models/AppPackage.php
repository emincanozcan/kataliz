<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AppPackage extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $appends = ['image_url'];

    public function pardusApps()
    {
        return $this->belongsToMany(PardusApp::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->image_path ? Storage::disk('public')->url($this->image_path) : "";
    }

}

