<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    private $usersAmount = 10000; //we can place it in config, DB or .env

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        // User::factory()->count($this->usersAmount)->create(); //works fine but I want to see the progress

        $totalAmount = $this->usersAmount;
        $startTime = time();

        for ($i = 0; $i < $totalAmount; $i++) {
            User::factory()->create();
            
            if (time() - $startTime >= 1) {
                $percentCompleted = ($i / $totalAmount) * 100;
                echo "Users seed progress: " . $percentCompleted . "% completed.\n";
                $startTime = time();
            }
        }

        echo "Insertion completed.\n";
    }
}
