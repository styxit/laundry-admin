<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * @var Generator Instance of faker which wil be used to create fake data.
     */
    protected $faker;

    /**
     * UsersSeeder constructor.
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
        // Start with a default user.
        $defaultUserUpdatedAt = $this->faker->dateTimeThisYear();
        $users = [
            [
                'name' => 'Test user',
                'email' => 'laundry@example.com',
                'password' => Hash::make(123456),
                'created_at' => $this->faker->dateTimeThisYear($defaultUserUpdatedAt),
                'updated_at' => $defaultUserUpdatedAt,
            ],
        ];

        // Add some random users.
        for ($i = 0; $i < $this->faker->numberBetween(2, 6); $i++) {
            $updatedAt = $this->faker->dateTimeThisYear();
            $users[] = [
                'name' => $this->faker->firstName().' '.$this->faker->lastName(),
                'email' => $this->faker->email,
                'password' => Hash::make(123456),
                'created_at' => $this->faker->dateTimeThisYear($updatedAt),
                'updated_at' => $updatedAt,
            ];
        }

        // Insert users into database.
        \DB::table('users')->insert($users);
    }
}
