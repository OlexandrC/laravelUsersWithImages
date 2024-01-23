<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserImagesTableSeeder extends Seeder
{
    private $imagesAmount = 100000; //we can place it in config, DB or.env
    private $batchSize = 5000;
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('user_images')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::statement('SET GLOBAL innodb_flush_log_at_trx_commit=0');
        DB::statement('ALTER TABLE user_images DISABLE KEYS');

        $userIds = User::all()->pluck('id')->toArray();
        $totalUsers = count($userIds);
        
        $userImages = [];
    
        for ($i = 0; $i < $this->imagesAmount; $i++) {
            $randomUserId = $userIds[rand(0, $totalUsers - 1)];

            $userImages[] = [
                'user_id' => $randomUserId,
                'image' => fake()->imageUrl(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
    
            if (count($userImages) >= $this->batchSize) {
                DB::table('user_images')->insert($userImages);
                $userImages = [];

                $percentCompleted = (($i+1) / $this->imagesAmount) * 100;
                echo PHP_EOL . "UserImage seed progress: " . $percentCompleted . "% completed. " . "(" . ($i+1) . ")";
            }
        }

        if (count($userImages) > 0) {
            DB::table('user_images')->insert($userImages);
            echo PHP_EOL . "UserImage seed progress: 100% completed. " . "(". $this->imagesAmount. ")";
        }

        DB::statement('ALTER TABLE user_images ENABLE KEYS');
        DB::statement('SET GLOBAL innodb_flush_log_at_trx_commit=1');
    
        echo PHP_EOL . "Insertion completed.\n";
    }

}
