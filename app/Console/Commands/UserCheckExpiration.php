<?php

namespace App\Console\Commands;

use App\Jobs\UserDeactivation;
use App\Mail\SendMail;
use App\Models\GroupsUser;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserCheckExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:check_expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Проверка пользователей на истечение даты';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $groups = GroupsUser::where('expired_at','<',Carbon::now())->with('user','group');
        $users = $groups->get();

        if($users) {
            foreach ($users as $user) {

                try {
                    Mail::to($user->user->email)->send(new SendMail($user));
                } catch (Exception $exception) {
                    Log::error("Ошибка отправки письма:". $user->user->name . " : " . $exception->getMessage());
                }

                UserDeactivation::dispatch($user->user->id);
            }
        }

        $groups->delete();



    }
}
