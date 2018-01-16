<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts() {

    	return $this->belongsToMany('App\Post');

    	//The function is as follows (if you don't follow the convention):
    	//belongsToMany('App\OtherModel', 'intermediary_table_name', 'current_model's_column_name', 'other_model's_column_name);

    	//Here I have followed the convention ie. using the exact table names as they are in the db so the last three parameters are not necessary (ie post_tag, tag_id and post_id). The name of the intermediary/pivot table is a combination of the names of the two models in alphabetical order separated by an underscore.
    	
    	


    }
}
