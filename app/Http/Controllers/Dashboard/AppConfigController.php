<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\AppConfig;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class AppConfigController extends Controller
{
  /**
   * Show configuration update form
   *
   * @return View
   */
  public function showAppConfig()
  {

    $this->checkPermission('appConfig');

    $config = AppConfig::first();
    return view('dashboard.app-config', compact('config'));
  }

  /**
   * Update configuration data from form
   *
   * @param Request $request
   * @return RedirectResponse
   */
  public function updateAppConfig(Request $request)
  {
    $this->checkPermission('appConfig');

    $data = $request->validate([
      'name' => ['required', 'string'],
      'description' => ['nullable', 'string'],
      'email' => ['required', 'string'],
      'helpline' => ['required', 'string'],
      'whatsapp_support' => ['nullable', 'string'],
      'fax' => ['nullable', 'string'],
      'facebook' => ['nullable', 'string'],
      'address' => ['required', 'string'],
      'working_days' => ['nullable', 'string'],
      'logo' => ['nullable', 'image'],
      'favicon' => ['nullable', 'image'],
    ]);

    $app_config = AppConfig::first();

    $app_config->update([
      'name' => $data['name'],
      'description' => $data['description'],
      'email' => $data['email'],
      'helpline' => $data['helpline'],
      'whatsapp_support' => $data['whatsapp_support'],
      'fax' => $data['fax'],
      'facebook' => $data['facebook'],
      'address' => $data['address'],
      'working_days' => $data['working_days'],
    ]);

    if ($request->hasFile('logo')) {
      $image = $request->file('logo');
      $imageName = 'logo-'.uniqid().'.'.$image->getClientOriginalExtension();

      $storage = Storage::disk('public');
      if ($storage->exists('config_images/'.$app_config->logo)) {
        $storage->delete('config_images/'.$app_config->logo);
      }

      $storage->put('config_images/'.$imageName, file_get_contents($image));

      $app_config->logo = $imageName;
      $app_config->save();
    }

    if ($request->hasFile('favicon')) {
      $image = $request->file('favicon');
      $imageName = 'favicon-'.uniqid().'.'.$image->getClientOriginalExtension();

      $storage = Storage::disk('public');
      if ($storage->exists('config_images/'.$app_config->favicon)) {
        $storage->delete('config_images/'.$app_config->favicon);
      }
      $storage->put('config_images/'.$imageName, file_get_contents($image));

      $app_config->favicon = $imageName;
      $app_config->save();
    }


    $message = 'App Configuration Successfully Updated.';
    return ($request->get('action') === 'update' ? redirect()->back() : redirect()->route('dashboard'))->with('success', $message);
  }
}
