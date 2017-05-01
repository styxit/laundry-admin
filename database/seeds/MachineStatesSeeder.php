<?php

use App\MachineJob;
use Faker\Factory;
use Illuminate\Database\Seeder;

class MachineStatesSeeder extends Seeder
{
    /**
     * @var Generator Instance of faker which wil be used to create fake data.
     */
    protected $faker;

    /**
     * MachineStatesSeeder constructor.
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
        // Collect all states to insert.
        $states = [];

        // Get all machine job ids and machine_id.
        $machineJobs = MachineJob::pluck('machine_id', 'id');

        foreach ($machineJobs as $jobId => $machineId) {
            // Add some random states for a job.
            for ($i = 0; $i < $this->faker->numberBetween(20, 200); ++$i) {
                $updatedAt = $this->faker->dateTimeThisYear();
                $states[] = [
                    'machine_id' => $machineId,
                    'machine_job_id' => $jobId,
                    'seconds_remaining' => $this->faker->numberBetween(0, 4000),
                    'created_at' => $this->faker->dateTimeThisYear($updatedAt),
                    'updated_at' => $updatedAt,
                ];
            }
        }

        // Insert machine states into database.
        \DB::table('machine_states')->insert($states);
    }
}
