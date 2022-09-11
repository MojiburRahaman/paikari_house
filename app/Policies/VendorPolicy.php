<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class VendorPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    function Vendor_Access($user)
    {
        if ($user->status == 2) {
            return true;
        }
        return false;
    }
    function Vendor_Access_Redirect($user)
    {
        if ($user->status == 2) {
            return true;
        }
        return false;
    }
}
