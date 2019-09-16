<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded  = [];
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function check_slug($slug, $id = 0){
        $sl = Category::where('slug', 'LIKE', $slug.'%')->get();        
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
