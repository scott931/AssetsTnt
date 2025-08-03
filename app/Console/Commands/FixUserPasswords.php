<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FixUserPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:fix-passwords {--email= : Specific email to fix} {--password=password : Default password to set}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix user passwords that are not properly hashed with Bcrypt';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->option('email');
        $defaultPassword = $this->option('password');

        if ($email) {
            // Fix specific user
            $user = User::where('email', $email)->first();

            if (!$user) {
                $this->error("User with email '{$email}' not found.");
                return 1;
            }

            $this->fixUserPassword($user, $defaultPassword);
            $this->info("Password fixed for user: {$user->email}");
        } else {
            // Fix all users with invalid passwords
            $users = User::all();
            $fixedCount = 0;

            foreach ($users as $user) {
                if ($this->needsPasswordFix($user)) {
                    $this->fixUserPassword($user, $defaultPassword);
                    $fixedCount++;
                    $this->info("Fixed password for: {$user->email}");
                }
            }

            $this->info("Fixed passwords for {$fixedCount} users.");
        }

        return 0;
    }

    /**
     * Check if user password needs to be fixed
     */
    private function needsPasswordFix(User $user): bool
    {
        // Check if password is not hashed or uses wrong algorithm
        if (empty($user->password)) {
            return true;
        }

        // Check if password doesn't start with $2y$ (Bcrypt format)
        if (!str_starts_with($user->password, '$2y$')) {
            return true;
        }

        return false;
    }

    /**
     * Fix user password
     */
    private function fixUserPassword(User $user, string $password): void
    {
        $user->password = Hash::make($password);
        $user->save();
    }
}