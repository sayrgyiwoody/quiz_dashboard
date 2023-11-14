<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'category_id',
        'title',
        'desc',
        'total_count',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
