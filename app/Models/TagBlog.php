<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagBlog extends Model
{
    use HasFactory;

    protected $table = 'tag_blog';

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'id_blog');
    }
    
    public function tag()
    {
        return $this->belongsTo(Tag::class, 'id_tag');
    }
    
}
