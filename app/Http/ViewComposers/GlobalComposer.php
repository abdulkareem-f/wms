<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class GlobalComposer
{
    public function compose(View $view){

        $user = auth()->user();
        $role = $crnt_user = '';

        if($user){
            $role = $user->role;
            $crnt_user = $user;
        }

        $view->with(compact('role', 'crnt_user'));
    }
}

?>