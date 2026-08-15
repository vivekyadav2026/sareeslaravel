<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CleanDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:clean {--force : Force the operation to run without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up database, removing all mock/transactional data while preserving admin user, products, categories, and settings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->option('force') && !$this->confirm('Are you sure you want to delete all transaction data, customer records, and non-admin users? This action is IRREVERSIBLE.')) {
            $this->info('Operation cancelled.');
            return 1;
        }

        $this->info('Starting database cleanup...');

        // Disable foreign key checks to avoid constraint violations during truncation
        Schema::disableForeignKeyConstraints();

        // 1. Truncate purely transactional/log tables
        $tablesToTruncate = [
            'orders',
            'order_items',
            'order_status_logs',
            'order_notes',
            'transactions',
            'wallet_transactions',
            'wishlists',
            'reviews',
            'appointments',
            'makeup_bookings',
            'custom_design_requests',
            'measurements',
            'admin_activity_logs',
            'contact_inquiries',
            'addresses',
            'failed_jobs',
            'job_batches',
            'jobs',
            'sessions',
            'cache',
            'cache_locks',
            'password_reset_tokens',
            'product_questions',
        ];

        foreach ($tablesToTruncate as $table) {
            if (Schema::hasTable($table)) {
                $this->comment("Truncating table: $table");
                DB::table($table)->truncate();
            }
        }

        // 2. Delete non-admin users and their linked customer records
        $this->info('Cleaning up users and customers...');
        
        // Delete customers first except the ones associated with the admin user (user_id = 1)
        $deletedCustomersCount = DB::table('customers')
            ->where(function ($query) {
                $query->whereNull('user_id')
                      ->orWhere('user_id', '!=', 1);
            })
            ->delete();
        $this->info("Deleted $deletedCustomersCount customer records.");

        // Delete all users except Admin (is_admin = 1 or email = admin@ranisahab.com)
        $deletedUsersCount = DB::table('users')
            ->where('is_admin', '!=', 1)
            ->where('email', '!=', 'admin@ranisahab.com')
            ->delete();
        $this->info("Deleted $deletedUsersCount non-admin users.");

        // Re-enable foreign key constraints
        Schema::enableForeignKeyConstraints();

        $this->info('Database cleanup completed successfully!');
        return 0;
    }
}
