<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CheckUserPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:check-permissions {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check user permissions for viewing registers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email') ?? 'john@gmail.com';

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email '{$email}' not found.");
            return 1;
        }

        $this->info("=== User Information ===");
        $this->info("Name: {$user->name}");
        $this->info("Email: {$user->email}");
        $this->info("Status: {$user->status}");
        $this->info("Created: {$user->created_at}");

        $this->info('');
        $this->info("=== User Roles ===");
        $roles = $user->roles;
        if ($roles->count() > 0) {
            foreach ($roles as $role) {
                $this->info("- {$role->name}");
            }
        } else {
            $this->warn("No roles assigned to user");
        }

        $this->info('');
        $this->info("=== User Permissions ===");
        $permissions = $user->getAllPermissions();
        if ($permissions->count() > 0) {
            foreach ($permissions as $permission) {
                $this->info("- {$permission->name}");
            }
        } else {
            $this->warn("No permissions assigned to user");
        }

        $this->info('');
        $this->info("=== Available Roles ===");
        $allRoles = Role::all();
        foreach ($allRoles as $role) {
            $this->info("- {$role->name}");
        }

        $this->info('');
        $this->info("=== Available Permissions ===");
        $allPermissions = Permission::all();
        foreach ($allPermissions as $permission) {
            $this->info("- {$permission->name}");
        }

        return 0;
    }
}