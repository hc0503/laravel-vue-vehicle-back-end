<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Device
 * @package App\Models
 */
class Device extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function deviceType()
    {
        return $this->hasOne(DeviceType::class);
    }

    public function token()
    {
        return $this->hasOne(DeviceToken::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function deviceGroup()
    {
        return $this->belongsTo(DeviceGroup::class);
    }

    public function attributes()
    {
        return $this->hasMany(DeviceAttribute::class);
    }

    public static function generateApiToken()
    {
        //TODO Implement proper api_token generation
        return \Str::random(15);
    }
}
