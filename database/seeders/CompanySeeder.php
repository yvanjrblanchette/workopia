<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Load company data from file
        $companies = include database_path('seeders/data/companies.php');

        foreach ($companies as &$company) {
            // Add timestamps
            $company['created_at'] = now();
            $company['updated_at'] = now();
        }

        try {
            // Insert company records
            DB::table('companies')->insert($companies);
            Log::info('Companies created successfully!'); // Log the success message
        } catch (\Exception $e) {
            Log::error('Failed to create companies: ' . $e->getMessage()); // Log the error
        }
    }
}
