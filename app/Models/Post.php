<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    const PUBLIC = "public";
    const DRAFT = "draft";
    const PRIVATE = "private";

    const VISIBILITY = [
        self::PUBLIC,
        self::DRAFT,
        self::PRIVATE
    ];

    protected $fillable = [
        'title',
        'content',
        'visibility',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }


    public static function getOwns(){
        return self::with('creator')->where("created_by",Auth::id())->get();
    }
    public static function getAllPublic() : Collection
    {
        return self::with('creator')->where("visibility",self::PUBLIC)->get("*");
    }
    public static function getAllVisible(){
        return self::whereIn("visibility",[self::PUBLIC,self::PRIVATE])
        ->get();
    }
}
