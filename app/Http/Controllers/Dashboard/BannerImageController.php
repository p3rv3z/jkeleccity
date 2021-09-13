<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BannerImage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BannerImageController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $this->checkPermission('banner_image.index');

    $banner_images = BannerImage::orderBy('id', $this->defaultOrderBy)->get();
    return view('dashboard.banner_image.index', compact('banner_images'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $this->checkPermission('banner_image.create');

    return view('dashboard.banner_image.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->checkPermission('banner_image.create');

    $request->validate($this->rules('save'));

    $banner_image = BannerImage::create([
      'segment' => $request->get('segment'),
    ]);

    if ($request->hasFile('image')) {
      $banner_image
      ->addMedia($request->image)
      ->toMediaCollection('banner_image');
    }

    $message = 'Banner Image Added.';
    return ($request->get('action') == 'save' ? redirect()->back() : redirect()->route('banner_image.index'))->with('success', $message);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $this->checkPermission('banner_image.edit');

    $banner_image = BannerImage::findOrFail($id);
    return view('dashboard.banner_image.edit', compact('banner_image'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $this->checkPermission('banner_image.edit');

    $request->validate($this->rules('update', $id));

    $banner_image = BannerImage::findOrFail($id);

    $banner_image->update([
      'segment' => $request->get('segment'),
    ]);

    if ($request->hasFile('image')) {
      $banner_image
      ->addMedia($request->image)
      ->toMediaCollection('banner_image');
    }

    $message = 'Banner Image information successfully updated.';
    return ($request->get('action') === 'update' ? back() : redirect()->route('banner_image.index'))->with('success', $message);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $this->checkPermission('banner_image.delete');

    $banner_image = BannerImage::find($id);

    if ($banner_image) {
      $banner_image->delete();
      return back()->with('success', 'Banner Image successfully deleted.');
    } else {
      return back()->with('error', 'Something wrong! Please, try again.');
    }
  }

  public function rules($action, $id = null)
  {

    return [
      'segment' => ['required', 'string', 'max:255'],
      'image' => ['required', 'image'],
      'action' => ['required', Rule::in([$action, $action . '&close'])],
    ];
  }
}
