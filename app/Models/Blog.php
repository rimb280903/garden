<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image_path',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_blog', 'id_blog', 'id_tag');
    }
}
