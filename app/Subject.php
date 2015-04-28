<?php namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model implements SluggableInterface {

	use SluggableTrait;
    
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'subjects';
    
    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'icon'];

    /**
	 * The attributes that are sluggable.
	 *
	 * @var array
	 */
    protected $sluggable = ['build_from' => 'name', 'save_to' => 'slug'];
}
