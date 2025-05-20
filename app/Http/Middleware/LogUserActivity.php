<?php

namespace App\Http\Middleware;

use App\Services\ActivityLogService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Proses request
        $response = $next($request);
        
        // Jika user sudah login dan request tidak termasuk aset statis
        if (Auth::check() && !$this->shouldIgnore($request)) {
            $this->logActivity($request);
        }
        
        return $response;
    }
    
    /**
     * Mencatat aktivitas pengguna berdasarkan request
     */
    protected function logActivity(Request $request): void
    {
        $user = Auth::user();
        $path = $request->path();
        $method = $request->method();
        
        // Hanya log untuk operasi POST, PUT, PATCH, DELETE
        if (in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            $action = $this->determineAction($method);
            $module = $this->determineModule($path);
            
            // Jika bisa menentukan modul, catat aktivitas
            if ($module) {
                $description = "User {$user->name} melakukan {$action} pada {$module}";
                
                // Catat aktivitas
                ActivityLogService::log([
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'user_role' => $user->role ?? 'user',
                    'action' => $action,
                    'module' => $module,
                    'description' => $description,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);
            }
        }
    }
    
    /**
     * Menentukan tipe aksi berdasarkan HTTP method
     */
    protected function determineAction(string $method): string
    {
        return match ($method) {
            'POST' => 'create',
            'PUT', 'PATCH' => 'update',
            'DELETE' => 'delete',
            default => 'access',
        };
    }
    
    /**
     * Menentukan modul berdasarkan path URL
     */
    protected function determineModule(string $path): ?string
    {
        // Contoh pemetaan path ke modul
        $pathPatterns = [
            'admin/payments' => 'payment',
            'admin/payment-types' => 'payment_type',
            'admin/users' => 'user',
            'admin/settings' => 'setting',
            'admin/reports' => 'report',
        ];
        
        foreach ($pathPatterns as $pattern => $module) {
            if (str_starts_with($path, $pattern)) {
                return $module;
            }
        }
        
        return null;
    }
    
    /**
     * Cek apakah request harus diabaikan untuk logging
     */
    protected function shouldIgnore(Request $request): bool
    {
        // Abaikan request ke aset statis
        $ignoredExtensions = ['js', 'css', 'jpg', 'jpeg', 'png', 'gif', 'ico', 'svg'];
        $path = $request->path();
        
        foreach ($ignoredExtensions as $ext) {
            if (str_ends_with($path, '.' . $ext)) {
                return true;
            }
        }
        
        // Abaikan request ke rute tertentu
        $ignoredPaths = [
            'admin/dashboard',
            'login',
            'logout',
            '_debugbar',
        ];
        
        foreach ($ignoredPaths as $ignoredPath) {
            if (str_starts_with($path, $ignoredPath)) {
                return true;
            }
        }
        
        return false;
    }
}
