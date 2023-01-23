<?php

namespace App\Observers;

use App\Models\Group;
use App\Models\GroupsUser;
use Carbon\Carbon;

class GroupsUserObserver
{

    /**
     * Handle the GroupsUser "created" event.
     *
     * @param  \App\Models\GroupsUser  $groupsUser
     * @return void
     */
    public function created(GroupsUser $groupsUser)
    {
        $hour = Group::where('id',$groupsUser->group_id)->first();
        $hour = $hour->expire_hours;
        $expired_at = Carbon::now()->addHours($hour);
        GroupsUser::where('group_id',$groupsUser->group_id)->where('user_id',$groupsUser->user_id)
            ->update(['expired_at' => $expired_at]);
    }

    /**
     * Handle the GroupsUser "updated" event.
     *
     * @param  \App\Models\GroupsUser  $groupsUser
     * @return void
     */
    public function updated(GroupsUser $groupsUser)
    {
        //
    }

    /**
     * Handle the GroupsUser "deleted" event.
     *
     * @param  \App\Models\GroupsUser  $groupsUser
     * @return void
     */
    public function deleted(GroupsUser $groupsUser)
    {
        //
    }

    /**
     * Handle the GroupsUser "restored" event.
     *
     * @param  \App\Models\GroupsUser  $groupsUser
     * @return void
     */
    public function restored(GroupsUser $groupsUser)
    {
        //
    }

    /**
     * Handle the GroupsUser "force deleted" event.
     *
     * @param  \App\Models\GroupsUser  $groupsUser
     * @return void
     */
    public function forceDeleted(GroupsUser $groupsUser)
    {
        //
    }
}
