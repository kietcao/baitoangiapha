<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class FamilyMember extends Model
{
    use HasFactory;

    protected $table = 'family_members';

    protected $fillable = [
        'id',
        'fullname',
        'role_name',
        'avatar',
        'birthday',
        'leaveday',
        'address',
        'phone',
        'email',
        'gender',
        'story',
        'position_index',
        'pids',
        'mid',
        'fid',
        'user_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the user that owns the FamilyMember
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getPidsAttribute($value)
    {
        if (!empty($value)) {
            return explode(',', $value);
        }
        
        return [];
    }

    public function age()
    {
        return Carbon::parse($this->attributes['birthday'])->age;
    }
}
