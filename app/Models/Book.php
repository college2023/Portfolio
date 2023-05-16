<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    
    public function getPaginateByLimit(int $limit_count = 5)
    {
        //updated_atで降順に並べたあと、limitで件数制限をかける。
        return $this::with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
        return $this::with('author')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    protected $fillable = [
    'title',
    'body',
    'category_id',
    'author_id'
    ];
    
    // Categoryに対するリレーション
    //「1対多」の関係なので単数系に
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Authorに対するリレーション
    //「1対多」の関係なので単数系に
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
