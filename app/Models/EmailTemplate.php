<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $fillable = [
        'name',
        'subject',
        'body',
        'trigger_type',
        'variables',
        'is_active'
    ];

    protected $casts = [
        'variables' => 'array',
        'is_active' => 'boolean'
    ];

    public function replaceVariables($data)
    {
        $subject = $this->subject;
        $body = $this->body;

        foreach ($data as $key => $value) {
            $subject = str_replace('{' . $key . '}', $value, $subject);
            $body = str_replace('{' . $key . '}', $value, $body);
        }

        return [
            'subject' => $subject,
            'body' => $body
        ];
    }

    public static function getTemplateByTrigger($triggerType)
    {
        return static::where('trigger_type', $triggerType)
            ->where('is_active', true)
            ->first();
    }
}
