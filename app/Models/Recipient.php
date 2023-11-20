<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Recipient
 *
 * @method static find(mixed $recipient_id)
 * @property int $id
 * @property string $recipient_type
 * @property string $recipient
 * @property string $allow_status
 * @property string $consent_date
 * @property int $firm_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient query()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereAllowStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereConsentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereFirmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereRecipient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereRecipientType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Recipient extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipient',
        'recipient_type',
        'consent_date',
        'allow_status',
        'firm_id'
    ];

    public function firm(){
        $this->belongsTo(Firm::class);
    }
}
