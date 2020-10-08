<?php

namespace App\Http\Controllers;

use App\Beer;
use App\Manufacturer;
use App\Type;
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
        $manuf = Manufacturer::where('id', $request->id)->get()->first();
        $manuf->update(array('name' => $request->name, 'address' => $request->address));


    }

    public function deleteManufacturer(Request $request)
    {
        $manuf = Manufacturer::where('id', $request->id)->get()->first();
        $manuf->delete();

    }

    public function filterManufacturer(Request $request)
    {
        $manufacturer_filtered = null;
        if ($request->type_filtered) {
            $temp = $request->type_filtered;
            $manufacturer_filtered = Manufacturer::whereHas('beer', function ($q) use ($temp) {
                $q->whereIn('type_id', $temp);
            })->get();

        }
        return $manufacturer_filtered;
    }

    public function manufacturer_index()
    {
        $tmp = Manufacturer::select('*')->get();
        return view('manufacturer', compact('tmp'));
    }

    public function createType(Request $request)
    {
        $type = Type::create([
            'name' => $request->name,
        ]);
        $type->save();
        return $type->id;
    }

    public function updateType(Request $request)
    {
        $type = Type::where('id', $request->id)->get()->first();
        $type->update(array('name' => $request->name));


    }

    public function deleteType(Request $request)
    {
        $type = Type::where('id', $request->id)->get()->first();
        $type->delete();

    }

    public function type_index()
    {
        $tmp = Type::select('*')->get();
        return view('type', compact('tmp'));
    }

    public function createBeer(Request $request)
    {
        $beer = Beer::create([
            'name' => $request->name,
            'description' => $request->description,
            'type_id' => $request->type_id,
            'manufacturer_id' => $request->manufacturer_id,
        ]);
        $beer->save();
        return $beer->id;
    }

    public function updateBeer(Request $request)
    {
        $beer = Beer::where('id', $request->id)->get()->first();
        $beer->update(array(
            'name' => $request->name,
            'description' => $request->description,
            'type_id' => $request->type_id,
            'manufacturer_id' => $request->manufacturer_id,
        ));


    }

    public function deleteBeer(Request $request)
    {
        $beer = Beer::where('id', $request->id)->get()->first();
        $beer->delete();

    }

    public function beer_index()
    {
        $tmp = Beer::select('*')->get();
        $type = Type::select('*')->get();
        $manufacturer = Manufacturer::select('*')->get();
        return view('beer', compact('tmp', 'type', 'manufacturer'));
    }

    public function manufacturer_f_index()
    {
        $tmp = Beer::select('*')->get();
        $type = Type::select('*')->get();
        $manufacturer = Manufacturer::select('*')->get();
        return view('manufacturer_f', compact('tmp', 'type', 'manufacturer'));
    }

    public function beer_f_index()
    {
        $tmp = Beer::select('*')->get();
        $type = Type::select('*')->get();
        $manufacturer = Manufacturer::select('*')->get();
        return view('beer_f', compact('tmp', 'type', 'manufacturer'));
    }
    public function index(){
        return view('index');
    }

}
