<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    
    public function getPaginateByLimit(int $limit_count = 5)
    {
        //updated_atで降順に並べたあと、limitで件数制限をかける。
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }

    protected $fillable = [
    'body',
    'address',
    'image_url', //追加
    'book_id',
    'user_id',
    'created_at',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
