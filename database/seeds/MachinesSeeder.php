<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

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
        // Collect machine records that will be inserted.
        $machines = [];

        // Add some random machines.
        for ($i = 0; $i < $this->faker->numberBetween(2, 15); ++$i) {
            $machines[] = [
                'name' => $this->faker->firstName().' '.$this->faker->lastName(),
            ];
        }

        // Insert machines into database.
        \DB::table('machines')->insert($machines);
    }
}