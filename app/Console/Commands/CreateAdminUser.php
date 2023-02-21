<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\SuccessEmailNotification;
use App\Notifications\WelcomeEmailNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'general:createadminuser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crate admin user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \DB::beginTransaction();

        try {
            $name = $this->ask('User full name');
            $username = $this->ask('User username');
            $email = $this->ask('User email');
            $currentDate = now();

            $user = User::create([
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'is_admin' => true,
                'hash' => (string)Str::uuid(),
                'hash_expire' => Carbon::now()->add(1, 'day'),
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ]);

            $user->notify(new WelcomeEmailNotification($user));

            $this->info('Super user successfully created!');
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::info($e);
            $this->error('Something wrong with creating super user!');
        }
    }
}
