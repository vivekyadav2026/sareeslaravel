<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LinkCustomersSeeder extends Seeder
{
    public function run(): void
    {
        $customers = Customer::all();
        
        foreach ($customers as $customer) {
            // Find or create User record for the customer
            $user = User::where('email', $customer->email)->first();
            
            if (!$user) {
                $user = User::create([
                    'name' => $customer->first_name . ' ' . $customer->last_name,
                    'email' => $customer->email,
                    'password' => Hash::make('password'),
                    'is_admin' => false,
                    'status' => 'active',
                    'email_verified_at' => now(),
                ]);
            }
            
            // Link customer to the user
            $customer->update([
                'user_id' => $user->id
            ]);
            
            $this->command->info("Linked customer {$customer->email} to User account.");
        }
    }
}
