<?php

use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MachinesSeeder extends Seeder
{
    /**
     * @var Generator Instance of faker which wil be used to create fake data.
     */
    protected $faker;

    /**
     * MachinesSeeder constructor.
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
        // Get all user ids to select a random user for the machine.
        $users = User::pluck('id');

        // Collect machine records that will be inserted.
        $machines = [];

        // Add some random machines.
        for ($i = 0; $i < $this->faker->numberBetween(15, 30); $i++) {
            $updatedAt = $this->faker->dateTimeThisYear();
            $machines[] = [
                'name' => $this->faker->firstName().' '.$this->faker->lastName(),
                'brand' => $this->faker->company(),
                'model' => ucfirst($this->faker->domainWord()).'-'.$this->faker->randomNumber(2),
                'token' => Str::random(32),
                'created_at' => $this->faker->dateTimeThisYear($updatedAt),
                'updated_at' => $updatedAt,
                // Link to a random user.
                'user_id' => $users->random(),
            ];
        }

        // Insert machines into database.
        \DB::table('machines')->insert($machines);
    }
}
