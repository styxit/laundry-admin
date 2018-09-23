<?php

use App\Machine;
use Faker\Factory;
use Illuminate\Database\Seeder;

class MachineJobsSeeder extends Seeder
{
    /**
     * @var Generator Instance of faker which wil be used to create fake data.
     */
    protected $faker;

    /**
     * MachineJobsSeeder constructor.
     */
    public function __construct()
    {
        $this->faker = Factory::create('en_US');
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all machine ids.
        $machineIds = Machine::pluck('id');

        foreach ($machineIds as $machineId) {
            // Collect jobs for this machine.
            $jobs = [];

            // Add some jobs for a machine.
            for ($i = 0; $i < $this->faker->numberBetween(10, 30); $i++) {
                $updatedAt = $this->faker->dateTimeThisYear();
                $jobs[] = [
                    'machine_id' => $machineId,
                    'duration' => $this->faker->numberBetween(1000, 4000),
                    'completed' => $this->faker->boolean(20),
                    'created_at' => $this->faker->dateTimeThisYear($updatedAt),
                    'updated_at' => $updatedAt,
                ];
            }

            // Insert machine jobs into database.
            \DB::table('machine_jobs')->insert($jobs);
        }
    }
}
