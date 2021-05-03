<?php

namespace App\Http\Controllers;

use App\Models\AppPackage;

class AppPackageController extends Controller
{
    public function index()
    {
        $data =  AppPackage::withCount('pardusApps')->get();

        return view('app-packages.list', ['appPackages' => $data]);
    }

    public function create()
    {
        return view('app-packages.create');
    }

    public function store()
    {
        $validatedData = request()->validate([
            'name' => 'required',
            'image_url' => 'required',
        ]);

        $package = AppPackage::create($validatedData);

        $package->pardusApps()->sync(request('pardus_apps') ?? []);

        return redirect(route('app-packages.index'))->with([
            'success' => $validatedData['name'] . " oluşturuldu."
        ]);
    }

    public function edit(AppPackage $appPackage)
    {
        $appPackage->load('pardusApps');
        return view('app-packages.edit', compact('appPackage'));
    }

    public function update(AppPackage $appPackage)
    {
        $validatedData = request()->validate([
            'name' => 'required',
            'image_url' => 'required',
        ]);

        $appPackage->update($validatedData);

        $appPackage->pardusApps()->sync(request('pardus_apps') ?? []);

        return redirect(route('app-packages.index'))->with([
            'success' => $validatedData['name'] . " güncellendi."
        ]);
    }

    public function destroy(AppPackage $appPackage)
    {
        $appPackage->pardusApps()->detach(
            $appPackage->pardusApps()->get()->pluck('id')->toArray()
        );

        $appPackage->delete();

        return redirect(route('app-packages.index'))->with([
            'success' => $appPackage->name . " silindi."
        ]);
    }

}
