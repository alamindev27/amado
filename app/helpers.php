<?php

use App\Models\User;

function AdminInfo()
{
    return User::where('id', auth()->id())->first();
}
