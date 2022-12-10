<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Log;

class Link extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'description',
        'default_url',
        'robot_url',
        'country_url',
        'device_url',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'country_url' => 'array',
        'device_url' => 'array',
    ];

    /**
     * Set the country url attribute.
     * 
     * @param array $value
     */
    public function setCountryUrlAttribute($value)
    {
        $country_url = [];

        foreach ($value as $item) {

            // Ignore empty fields.
            if (!is_null($item['url']) && !is_null($item['code'])) {
                $country_url[] = $item;
            }

        }

        // Set attribute to json.
        $this->attributes['country_url'] = json_encode($country_url, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }

    /**
     * Set the device url attribute.
     * 
     * @param array $value
     */
    public function setDeviceUrlAttribute($value)
    {
        $device_url = [];

        foreach ($value as $item) {
 
            // Ignore empty fields.
            if (!is_null($item['url']) && !is_null($item['code'])) {
                $device_url[] = $item;
            }

        }

        // Set attribute to json.
        $this->attributes['device_url'] = json_encode($device_url, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }
}
