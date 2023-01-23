<?php

namespace App\Console\Commands;

use App\Models\GroupsUser;
use App\Models\User;
use Illuminate\Console\Command;

class UserMember extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:member';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Добавление пользователя в группу';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $useId = $this->ask('Введите id пользлвателя');
        $groupId = $this->ask('Введите id группы');

        $add = new GroupsUser();
        $add ->user_id = $useId;
        $add ->group_id = $groupId;
        $add->save();

        $user = User::where('id',$useId)->first();
        if($user->active === 'false'){
            $user->active = 'true';
            $user->save();
        }

    }
}
