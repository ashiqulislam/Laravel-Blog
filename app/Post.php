<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded  = [];
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function cateegory(){
        return $this->hasOne('App\Category','id', 'category_id');
    }

    public static function check_slug($slug, $id = 0){
        if($id == 0){
            $sl = Post::where('slug', 'LIKE', $slug.'%')->get();
        } else {
            $sl = Post::where('slug', 'LIKE', $slug.'%')->where('id', '!=', $id)->get();
        }        
        $data =[];
        foreach ($sl as  $value) {
            $data[] = $value->slug;
        }
        if(in_array($slug, $data)){
            $count =0;
            while(in_array(($slug . '-'.++$count), $data));
            $slug = $slug.'-'.$count;
        }
        return $slug;
    }
}
