<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Firm
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Recipient> $recipients
 * @property-read int|null $recipients_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Firm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Firm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Firm query()
 * @method static \Illuminate\Database\Eloquent\Builder|Firm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Firm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Firm whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Firm whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Firm extends Model
{
    use HasFactory;

    public function users(){
        return $this->hasMany(User::class);
    }

    public function recipients(){
         return $this->hasMany(Recipient::class,'firm_id');
    }

}
