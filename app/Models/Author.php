<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    
    // Bookに対するリレーション
    //「1対多」の関係なので'books'と複数形に
    public function books()   
    {
        return $this->hasMany(Book::class);  
    }
    
    public function getByAuthor(int $limit_count = 5)
    {
        return $this->books()->with('author')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }

}
