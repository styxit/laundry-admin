<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /**
     * @var User The User model.
     */
    private $user;

    /**
     * Create a new command instance.
     *
     * @param User $user The User model.
     */
    public function __construct(User $user)
    {
        parent::__construct();

        $this->user = $user;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Ask for the new user's name.
        $name = $this->ask('What is the name of the new user:');
        // Ask for the new user's email.
        $email = $this->ask(sprintf('What is the email address of %s?', $name));
        // Ask for the new user's email.
        $password = $this->secret(sprintf('Provide a password for %s: (hidden)', $name));

        $user = new $this->user([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        if($user->save()) {
            $this->info(sprintf('User %s has been created.', $name));
        } else {
            $this->error(sprintf('User %s cloud not be created.', $name));
        }
    }
}
