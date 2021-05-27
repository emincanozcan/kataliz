<?php

namespace App\Http\Controllers;

use App\Models\NonPardusApp;

class NonPardusAppController extends Controller
{

    public function index()
    {
        return view('non-pardus-apps.list', [
            'nonPardusApps' => NonPardusApp::paginate(20)
        ]);
    }

    public function create()
    {
        return view('non-pardus-apps.create');
    }

    public function store()
    {
        $validatedData = request()->validate([
            'name' => 'required',
            'image_url' => 'required',
        ]);

        $nonPardusApp = NonPardusApp::create($validatedData);

        $nonPardusApp->pardusApps()->sync(request('pardus_apps') ?? []);

        return redirect(route('non-pardus-apps.index'))->with([
            'success' => $validatedData['name'] . " oluşturuldu."
        ]);
    }

    public function edit(NonPardusApp $nonPardusApp)
    {
        $nonPardusApp->load('pardusApps');
        return view('non-pardus-apps.edit', compact('nonPardusApp'));
    }

    public function update(NonPardusApp $nonPardusApp)
    {
        $validatedData = request()->validate([
            'name' => 'required',
            'image_url' => 'required',
        ]);

        $nonPardusApp->update($validatedData);

        $nonPardusApp->pardusApps()->sync(request('pardus_apps') ?? []);

        return redirect(route('non-pardus-apps.index'))->with([
            'success' => $validatedData['name'] . " güncellendi."
        ]);
    }

    public function destroy(NonPardusApp $nonPardusApp)
    {
        $nonPardusApp->pardusApps()->detach(
            $nonPardusApp->pardusApps()->get()->pluck('id')->toArray()
        );

        $nonPardusApp->delete();

        return redirect(route('non-pardus-apps.index'))->with([
            'success' => $nonPardusApp->name . " silindi."
        ]);
    }

}
