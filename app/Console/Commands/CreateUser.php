<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {--role=user : The role of the user (user/business/admin)} {--name= : The name of the user} {--email= : The email of the user} {--password= : The password for the user} {--phone= : The phone number} {--address= : The address}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user with specified role and details';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $role = $this->option('role');
        $name = $this->option('name') ?? $this->ask('What is the name of the user?');
        $email = $this->option('email') ?? $this->ask('What is the email of the user?');
        $password = $this->option('password') ?? $this->secret('What is the password for the user?');
        $phone = $this->option('phone') ?? $this->ask('What is the phone number?');
        $address = $this->option('address') ?? $this->ask('What is the address?');

        // Validate role
        if (!in_array($role, ['user', 'business', 'admin'])) {
            $this->error('Invalid role. Must be one of: user, business, admin');
            return 1;
        }

        try {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'role' => $role,
                'phone' => $phone,
                'address' => $address,
                'status' => 'active'
            ]);

            $this->info("User created successfully!");
            $this->table(
                ['Name', 'Email', 'Role', 'Phone', 'Address'],
                [[$user->name, $user->email, $user->role, $user->phone, $user->address]]
            );
        } catch (\Exception $e) {
            $this->error("Failed to create user: " . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
