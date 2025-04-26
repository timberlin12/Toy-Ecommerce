<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
/**
 * App\Models\PostCategory
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Post[] $post
 * @property-read int|null $post_count
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PostCategory extends Model
{
    protected $fillable=['title','slug','status'];

    public function post(){
        return $this->hasMany('App\Models\Post','post_cat_id','id')->where('status','active');
    }

    public static function getBlogByCategory($slug){
        return PostCategory::with('post')->where('slug',$slug)->first();
    }
}
