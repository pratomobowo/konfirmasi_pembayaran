<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Role constants
     */
    const ROLE_SUPER_ADMIN = 'super_admin';
    const ROLE_ADMIN_KEUANGAN = 'admin_keuangan';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    /**
     * Check if the user is an admin (any admin role).
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return in_array($this->role, [self::ROLE_SUPER_ADMIN, self::ROLE_ADMIN_KEUANGAN]);
    }
    
    /**
     * Check if the user is a super admin.
     *
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }
    
    /**
     * Check if the user is a finance admin.
     *
     * @return bool
     */
    public function isFinanceAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN_KEUANGAN;
    }
    
    /**
     * Get all available roles.
     *
     * @return array
     */
    public static function getRoles(): array
    {
        return [
            self::ROLE_SUPER_ADMIN => 'Super Admin',
            self::ROLE_ADMIN_KEUANGAN => 'Admin Keuangan',
        ];
    }
    
    /**
     * Get the roles that can be assigned by the current user.
     *
     * @param User $user
     * @return array
     */
    public static function getAssignableRoles(User $user): array
    {
        if ($user->isSuperAdmin()) {
            return self::getRoles();
        } elseif ($user->isFinanceAdmin()) {
            return [
                self::ROLE_ADMIN_KEUANGAN => 'Admin Keuangan',
            ];
        }
        
        return [];
    }
}
