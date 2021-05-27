<?php

namespace App\Http\Controllers;

use App\Models\PardusApp;

class PardusAppController extends Controller
{
    public function index()
    {
        return view('pardus-apps.list', [
            'pardusApps' => PardusApp::paginate(20)
        ]);
    }

    public function create()
    {
        return view('pardus-apps.create');
    }

    public function store()
    {
        $validatedData = request()->validate([
            'name' => 'required',
            'image_path' => 'required',
            'scripts' => 'nullable|array'
        ]);

        $pardusApp = PardusApp::create($validatedData);

        return redirect(route('pardus-apps.index'))->with([
            'success' => $validatedData['name'] . " oluşturuldu."
        ]);
    }

    public function edit(PardusApp $pardusApp)
    {
        return view('pardus-apps.edit', compact('pardusApp'));
    }

    public function update(PardusApp $pardusApp)
    {
        $validatedData = request()->validate([
            'name' => 'required',
            'image_path' => 'required',
            'scripts' => 'nullable|array'
        ]);

        $pardusApp->update($validatedData);

        return redirect(route('pardus-apps.index'))->with([
            'success' => $validatedData['name'] . " güncellendi."
        ]);
    }

    public function destroy(PardusApp $pardusApp)
    {
        $pardusApp->delete();

        return redirect(route('pardus-apps.index'))->with([
            'success' => $pardusApp->name . " silindi."
        ]);
    }
}
