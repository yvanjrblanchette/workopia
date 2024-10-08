<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Load job listings from file
        $jobListings = include database_path('seeders/data/job_listings.php');

        foreach ($jobListings as &$listing) {
            // Add timestamps
            $listing['created_at'] = now();
            $listing['updated_at'] = now();
        }

        try {
            // Insert job listings
            DB::table('job_listings')->insert($jobListings);
        } catch (\Exception $e) {
            Log::error('Failed to create jobs: ' . $e->getMessage()); // Log the error
        }
    }
}
