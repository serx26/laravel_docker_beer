<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function createManufacturer()
    {
        $manf = new User;
        $manf->name = "Vasya";
        $manf->address = "vasya@gmail.com";
    }

    public function getUsers()
    {
        $tmp = User::select('*')->get()->pluck('name','id' )->toArray();
        dump($tmp);
    }
}
