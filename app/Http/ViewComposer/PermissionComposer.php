<?php

namespace App\Http\ViewComposer;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PermissionComposer
{
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $user = auth()->user();
        if ($user) {
            if ($user->role->name == "super_admin") {
                $view->with('super_admin', true);
            }else {
                $permissions = DB::select('
                    SELECT permissions.name
                    FROM user_permissions
                    INNER JOIN permissions
                    ON permissions.id = user_permissions.permission_id
                    WHERE user_id = ' . $user->id . '
                ');

                foreach ($permissions as $permission) {
                    $view->with("" . $permission->name . "", true);
                }
            }
        }
    }
}
