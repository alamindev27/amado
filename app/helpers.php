<?php

use App\Models\Product;
use App\Models\User;

function AdminInfo()
{
    return User::where('id', auth()->id())->first();
}
function getCountProdut($id)
{
    return Product::where('user_id', $id)->count();
}
