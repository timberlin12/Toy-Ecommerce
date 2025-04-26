<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $summary
 * @property string|null $description
 * @property string|null $quote
 * @property string|null $photo
 * @property string|null $tags
 * @property int|null $post_cat_id
 * @property int|null $post_tag_id
 * @property int|null $added_by
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostComment[] $allComments
 * @property-read int|null $all_comments_count
 * @property-read \App\User|null $author_info
 * @property-read \App\Models\PostCategory|null $cat_info
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostComment[] $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\PostTag|null $tag_info
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePostCatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePostTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereQuote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
    protected $fillable=['title','tags','summary','slug','description','photo','quote','post_cat_id','post_tag_id','added_by','status'];


    public function cat_info(){
        return $this->hasOne('App\Models\PostCategory','id','post_cat_id');
    }
    public function tag_info(){
        return $this->hasOne('App\Models\PostTag','id','post_tag_id');
    }

    public function author_info(){
        return $this->hasOne('App\User','id','added_by');
    }
    public static function getAllPost(){
        return Post::with(['cat_info','author_info'])->orderBy('id','DESC')->paginate(10);
    }
    // public function get_comments(){
    //     return $this->hasMany('App\Models\PostComment','post_id','id');
    // }
    public static function getPostBySlug($slug){
        return Post::with(['tag_info','author_info'])->where('slug',$slug)->where('status','active')->first();
    }

    public function comments(){
        return $this->hasMany(PostComment::class)->whereNull('parent_id')->where('status','active')->with('user_info')->orderBy('id','DESC');
    }
    public function allComments(){
        return $this->hasMany(PostComment::class)->where('status','active');
    }


    // public static function getProductByCat($slug){
    //     // dd($slug);
    //     return Category::with('products')->where('slug',$slug)->first();
    //     // return Product::where('cat_id',$id)->where('child_cat_id',null)->paginate(10);
    // }

    // public static function getBlogByCategory($id){
    //     return Post::where('post_cat_id',$id)->paginate(8);
    // }
    public static function getBlogByTag($slug){
        // dd($slug);
        return Post::where('tags',$slug)->paginate(8);
    }

    public static function countActivePost(){
        $data=Post::where('status','active')->count();
        if($data){
            return $data;
        }
        return 0;
    }
}
