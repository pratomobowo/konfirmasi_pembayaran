<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLogService
{
    /**
     * Log ketika user login
     * 
     * @param User $user
     * @return ActivityLog
     */
    public static function logLogin(User $user): ActivityLog
    {
        return self::log([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_role' => $user->role ?? 'user',
            'action' => 'login',
            'module' => 'auth',
            'description' => "User {$user->name} berhasil login",
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }

    /**
     * Log ketika user logout
     * 
     * @param User $user
     * @return ActivityLog
     */
    public static function logLogout(User $user): ActivityLog
    {
        return self::log([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_role' => $user->role ?? 'user',
            'action' => 'logout',
            'module' => 'auth',
            'description' => "User {$user->name} telah logout",
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }

    /**
     * Log aktivitas create
     * 
     * @param string $module Nama modul (contoh: 'payment', 'user', dll)
     * @param string $description Deskripsi aktivitas
     * @param mixed $model Model yang dibuat
     * @param int|null $referenceId ID referensi (opsional)
     * @return ActivityLog
     */
    public static function logCreate(string $module, string $description, $model = null, ?int $referenceId = null): ActivityLog
    {
        $user = Auth::user();
        
        $data = [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_role' => $user->role ?? 'user',
            'action' => 'create',
            'module' => $module,
            'description' => $description,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ];

        if ($referenceId) {
            $data['reference_id'] = $referenceId;
        }

        if ($model) {
            $data['new_values'] = self::sanitizeArrayForJson($model->toArray());
        }

        return self::log($data);
    }

    /**
     * Log aktivitas update
     * 
     * @param string $module Nama modul
     * @param string $description Deskripsi aktivitas
     * @param array $oldValues Nilai lama
     * @param array $newValues Nilai baru
     * @param int|null $referenceId ID referensi (opsional)
     * @return ActivityLog
     */
    public static function logUpdate(string $module, string $description, array $oldValues, array $newValues, ?int $referenceId = null): ActivityLog
    {
        $user = Auth::user();
        
        // Sanitize arrays to ensure they can be properly JSON encoded
        $sanitizedOldValues = self::sanitizeArrayForJson($oldValues);
        $sanitizedNewValues = self::sanitizeArrayForJson($newValues);
        
        $data = [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_role' => $user->role ?? 'user',
            'action' => 'update',
            'module' => $module,
            'description' => $description,
            'old_values' => $sanitizedOldValues,
            'new_values' => $sanitizedNewValues,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ];

        if ($referenceId) {
            $data['reference_id'] = $referenceId;
        }

        return self::log($data);
    }

    /**
     * Log aktivitas delete
     * 
     * @param string $module Nama modul
     * @param string $description Deskripsi aktivitas
     * @param mixed $model Model atau array data yang dihapus
     * @param int|null $referenceId ID referensi (opsional)
     * @return ActivityLog
     */
    public static function logDelete(string $module, string $description, $model = null, ?int $referenceId = null): ActivityLog
    {
        $user = Auth::user();
        
        $data = [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_role' => $user->role ?? 'user',
            'action' => 'delete',
            'module' => $module,
            'description' => $description,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ];

        if ($referenceId) {
            $data['reference_id'] = $referenceId;
        }

        if ($model) {
            // Check if $model is already an array
            if (is_array($model)) {
                $data['old_values'] = self::sanitizeArrayForJson($model);
            } else {
                // Otherwise, assume it's an object with toArray() method
                $data['old_values'] = self::sanitizeArrayForJson($model->toArray());
            }
        }

        return self::log($data);
    }

    /**
     * Log aktivitas umum
     * 
     * @param array $data Data log
     * @return ActivityLog
     */
    public static function log(array $data): ActivityLog
    {
        return ActivityLog::create($data);
    }
    
    /**
     * Sanitize an array to ensure it can be properly JSON encoded and stored in the database
     * 
     * @param array $array The array to sanitize
     * @return array The sanitized array
     */
    private static function sanitizeArrayForJson(array $array): array
    {
        // Convert any objects with __toString() to strings
        // Remove any circular references or resources that can't be JSON encoded
        $result = [];
        
        foreach ($array as $key => $value) {
            // Skip resource types
            if (is_resource($value)) {
                continue;
            }
            
            // Handle nested arrays recursively
            if (is_array($value)) {
                $result[$key] = self::sanitizeArrayForJson($value);
                continue;
            }
            
            // Handle objects
            if (is_object($value)) {
                // If object has __toString method, use it
                if (method_exists($value, '__toString')) {
                    $result[$key] = (string) $value;
                } 
                // If it's a DateTime object, format it
                else if ($value instanceof \DateTime) {
                    $result[$key] = $value->format('Y-m-d H:i:s');
                }
                // For other objects, try to convert to array if possible
                else if (method_exists($value, 'toArray')) {
                    $result[$key] = self::sanitizeArrayForJson($value->toArray());
                }
                // Otherwise just store the class name
                else {
                    $result[$key] = get_class($value) . ' object';
                }
                continue;
            }
            
            // Handle scalar values
            $result[$key] = $value;
        }
        
        return $result;
    }
} 