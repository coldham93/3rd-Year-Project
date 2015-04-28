<?php namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Book extends Model implements SluggableInterface {

	use SluggableTrait;
    
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'books';
    
    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
    protected $fillable = ['image', 'title', 'author', 'isbn', 'price', 'description', 'status', 'subject_id', 'user_id'];
    
    /**
	 * The attributes that are sluggable.
	 *
	 * @var array
	 */
    protected $sluggable = ['build_from' => 'title', 'save_to' => 'slug'];
    
    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function scopeForSale($query)
    {
        return $query->whereStatus('available');
    }
}
