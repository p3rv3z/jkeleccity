<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$permissions = Permission::orderBy('id', $this->defaultOrderBy)->paginate($this->itemPerPage);
		$this->putSL($permissions);
		return view('dashboard.permission.index', compact('permissions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('dashboard.permission.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required|string',
		]);

		Permission::create(['name' => $request->get('name')]);

		$message = 'New Permission Added.';
		return ($request->get('action') == 'save' ? back() : redirect()->route('permission.index'))->with('success', $message);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$permission = Permission::findOrFail($id);
		return view('dashboard.permission.edit', compact('permission'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$request->validate([
			'name' => 'required|string',
		]);

		Permission::findOrFail($id)->update(['name' => $request->get('name')]);

		$message = 'Permission Updated.';
		return ($request->get('action') == 'update' ? back() : redirect()->route('permission.index'))->with('success', $message);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
    $item = Permission::find($id);

    if ($item) {
      $item->delete();
      return back()->with('success', 'Permission Deleted.');
    } else {
      return back()->with('error', 'Permission Not Found.');
    }
	}
}
