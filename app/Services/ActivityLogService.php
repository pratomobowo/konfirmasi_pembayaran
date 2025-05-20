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
            $data['new_values'] = $model->toArray();
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
        
        $data = [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_role' => $user->role ?? 'user',
            'action' => 'update',
            'module' => $module,
            'description' => $description,
            'old_values' => $oldValues,
            'new_values' => $newValues,
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
     * @param mixed $model Model yang dihapus
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
            $data['old_values'] = $model->toArray();
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
} 