<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
    protected $fillable = ['status', 'book_id', 'review_id', 'user_id'];
    
    /**
	 * Returns the book of an order
	 *
	 * @return Relation
	 */
    public function book()
    {
        return $this->belongsTo('App\Book');
    }
    
    /**
	 * Returns the review of an order
	 *
	 * @return Relation
	 */
    public function review()
    {
        return $this->belongsTo('App\Review');
    }
    
    /**
	 * Returns the user of an order
	 *
	 * @return Relation
	 */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    /**
	 * Scopes a collection of orders to those that belong to a user 
	 *
	 * @return QueryBuilder
	 */
	public function scopeFrom($query, User $user)
    {
        /*return $query->whereHas('user', function($_query) use ($user)
        {
            return $_query->where('id', $user->id);
        });*/
    }

}
