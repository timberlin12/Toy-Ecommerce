<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductReview
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $product_id
 * @property int $rate
 * @property string|null $review
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product|null $product
 * @property-read \App\User|null $user_info
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReview newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReview newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReview query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReview whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReview whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReview whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReview whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReview whereReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReview whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReview whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductReview whereUserId($value)
 * @mixin \Eloquent
 */
class ProductReview extends Model
{
    protected $fillable=['user_id','product_id','rate','review','status'];

    public function user_info(){
        return $this->hasOne('App\User','id','user_id');
    }

    public static function getAllReview(){
        return ProductReview::with('user_info')->get();
    }
    public static function getAllUserReview(){
        return ProductReview::where('user_id',auth()->user()->id)->with('user_info')->get();
    }

    public function product(){
        return $this->hasOne(Product::class,'id','product_id');
    }

}
