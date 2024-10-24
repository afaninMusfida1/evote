<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'nomor_urut', 'image', 'visi_misi'];

    public function getImageUrlAttribute()
{
    return asset('storage/' . $this->image);
}

}




