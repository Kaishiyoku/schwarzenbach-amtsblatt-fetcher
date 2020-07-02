<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\File
 *
 * @property int $id
 * @property int $no
 * @property string $original_filename
 * @property string $mimetype
 * @property string $extension
 * @property int $size
 * @property \Illuminate\Support\Carbon $published_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereMimetype($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereOriginalFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereSize($value)
 * @mixin \Eloquent
 */
class File extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'published_at' => 'date',
    ];
}
