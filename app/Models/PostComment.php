<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PostComment
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $post_id
 * @property string $comment
 * @property string $status
 * @property string|null $replied_comment
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Post|null $post
 * @property-read \Illuminate\Database\Eloquent\Collection|PostComment[] $replies
 * @property-read int|null $replies_count
 * @property-read \App\User|null $user_info
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereRepliedComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereUserId($value)
 * @mixin \Eloquent
 */
class PostComment extends Model
{
    protected $fillable=['user_id','post_id','comment','replied_comment','parent_id','status'];

    public function user_info(){
        return $this->hasOne('App\User','id','user_id');
    }
    public static function getAllComments(){
        return PostComment::with('user_info')->paginate(10);
    }

    public static function getAllUserComments(){
        return PostComment::where('user_id',auth()->user()->id)->with('user_info')->get();
    }

    public function post(){
        return $this->belongsTo(Post::class,'post_id','id');
    }

    public function replies(){
        return $this->hasMany(PostComment::class,'parent_id')->where('status','active');
    }
}
