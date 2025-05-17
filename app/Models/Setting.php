<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'group',
        'description'
    ];

    /**
     * Get a setting value by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function getValueByKey(string $key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Get all settings in a specific group
     *
     * @param string $group
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getByGroup(string $group)
    {
        return self::where('group', $group)->get();
    }

    /**
     * Set a setting value
     *
     * @param string $key
     * @param mixed $value
     * @param string|null $group
     * @param string|null $description
     * @return Setting
     */
    public static function setValueByKey(string $key, $value, string $group = null, string $description = null)
    {
        $setting = self::firstOrNew(['key' => $key]);
        $setting->value = $value;
        
        if ($group) {
            $setting->group = $group;
        }
        
        if ($description) {
            $setting->description = $description;
        }
        
        $setting->save();
        return $setting;
    }
}
