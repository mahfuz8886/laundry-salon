<?php

namespace App\helper;

use App\User;
use Illuminate\Support\Facades\Auth;

    class CustomHelper {

        // get branches
        public static function getUserBranch() {
            $userInfo = User::where('id', Auth::id())->first();
            if($userInfo->branches) {
                $branches = explode(',',$userInfo->branches);
                return $branches;
            }else {
                return null;
            }
        }
    }

?>