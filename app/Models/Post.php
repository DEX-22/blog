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
    const ONLY_ME= "only-me";
    const DRAFT = "draft";
    const PRIVATE = "private";

    const ICON_PUBLIC = "eye";
    const ICON_ONLY_ME= "user";
    const ICON_DRAFT = "edit-2";
    const ICON_PRIVATE = "lock";

    const VISIBILITY = [
        self::ONLY_ME,
        self::PUBLIC,
        self::DRAFT,
        self::PRIVATE
    ];

    const VISIBILITY_OPTIONS = [
        self::ONLY_ME=> ["label"=>"Solo yo" ,"icon"=>self::ICON_PUBLIC],
        self::PUBLIC=> ["label"=> "Publico","icon"=>self::ICON_ONLY_ME],
        self::DRAFT=> ["label"=> "Borrador","icon"=>self::ICON_DRAFT],
        self::PRIVATE=> ["label"=>"Privado" ,"icon"=>self::ICON_PRIVATE]
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

    protected $appends = ["visibility_icon","visibility_label"];

    public function getVisibilityIconAttribute(){
        return match($this->visibility){
            self::ONLY_ME => self::ICON_ONLY_ME,
            self::DRAFT => self::ICON_DRAFT,
            self::PRIVATE => self::ICON_PRIVATE,
            default => self::ICON_PUBLIC
        };
    }

    public function getVisibilityLabelAttribute(){
        return match($this->visibility){
            self::ONLY_ME => "Solo yo",
            self::DRAFT => "Borrador",
            self::PRIVATE => "Privado",
            default => "Publico"
        };
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

    public static function getOwns(){
        return self::with('creator')->where("created_by",Auth::id())
        ->orderBy("created_at","desc")
        ->get();
    }
    public static function getAllPublic() : Collection
    {
        return self::with('creator')->where("visibility",self::PUBLIC)
        ->orderBy("created_at","desc")->get("*");
    }
    public static function getAllVisible(){
        return self::with('creator')->whereIn("visibility",[self::PUBLIC,self::PRIVATE])
        ->orderBy("created_at","desc")
        ->get("*");
    }
}
