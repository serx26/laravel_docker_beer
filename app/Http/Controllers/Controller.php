<?php

namespace App\Http\Controllers;

use App\Manufacturer;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function createManufacturer(Request $request)
    {
        $manuf = Manufacturer::create([
            'name' => $request->name,
            'address' => $request->address,
        ]);
        $manuf->save();
        return $manuf->id;
    }
    public function updateManufacturer(Request $request)
    {
      $manuf = Manufacturer::where('id',  $request->id)->get()->first();
      $manuf->update(array('name' => $request->name,'address' => $request->address));


    }
    public function deleteManufacturer(Request $request)
    {
        $manuf = Manufacturer::where('id',  $request->id)->get()->first();
        $manuf->delete();

    }

    public function getManufacturers()
    {
        $tmp = Manufacturer::select('*')->get()->pluck('name','address' )->toArray();
        dump($tmp);
    }

    public function index()
    {
        $tmp = Manufacturer::select('*')->get();
        return view('beer', compact('tmp'));
    }
}
