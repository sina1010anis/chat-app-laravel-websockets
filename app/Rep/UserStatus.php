<?php

namespace App\Rep;

use App\Models\User;

trait UserStatus{
    public function isOnline($user_id)
    {
        User::whereId($user_id)->update(['status' => 1]);
    }

    public function isOffline($user_id)
    {
        User::whereId($user_id)->update(['status' => 0]);
    }
}
