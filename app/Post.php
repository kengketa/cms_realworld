<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = [
            'title','description','content','published_at','image','category_id'
        ];

    public function deleteImage(){
        Storage::delete($this->image);
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
    /**
     * check if a post has tag
     * @return bool
     * 
     */


    public function hasTag($tagId){
        return in_array($tagId,$this->tags->pluck('id')->toArray());
    }
}
