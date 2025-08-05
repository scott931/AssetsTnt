<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AssignUserRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:assign-role {email} {role}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign a role to a user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $roleName = $this->argument('role');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email '{$email}' not found.");
            return 1;
        }

        $role = Role::where('name', $roleName)->first();

        if (!$role) {
            $this->error("Role '{$roleName}' not found.");
            $this->info("Available roles:");
            $roles = Role::all();
            foreach ($roles as $r) {
                $this->info("- {$r->name}");
            }
            return 1;
        }

        // Remove existing roles and assign new one
        $user->syncRoles([$roleName]);

        $this->info("✅ Successfully assigned role '{$roleName}' to user '{$email}'");

        // Show updated user roles
        $this->info('');
        $this->info("User roles after assignment:");
        $userRoles = $user->roles;
        foreach ($userRoles as $userRole) {
            $this->info("- {$userRole->name}");
        }

        return 0;
    }
}