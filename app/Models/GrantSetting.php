<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class GrantSetting extends Model
{
    protected $fillable = ['setting_key', 'setting_value', 'description'];

    // ✅ Get setting with caching
    public static function get($key, $default = null)
    {
        return Cache::remember("grant_setting_{$key}", 3600, function () use ($key, $default) {
            $setting = self::where('setting_key', $key)->first();
            return $setting ? $setting->setting_value : $default;
        });
    }

    // ✅ Update setting and clear cache
    public static function set($key, $value)
    {
        self::updateOrCreate(
            ['setting_key' => $key],
            ['setting_value' => $value]
        );
        Cache::forget("grant_setting_{$key}");
    }
}
