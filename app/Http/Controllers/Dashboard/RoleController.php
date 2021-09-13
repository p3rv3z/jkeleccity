<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$roles = Role::orderBy('id', $this->defaultOrderBy)->paginate($this->itemPerPage);
		$this->putSL($roles);
		return view('dashboard.role.index', compact('roles'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$permissions = Permission::all();
		return view('dashboard.role.create', compact('permissions'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
    // dd($request->get('permissions'));
		$request->validate([
			'name'        => 'required|string',
			'permissions' => 'nullable|array|exists:permissions,id',
		]);

		$role = Role::create(['name' => $request->get('name')]);

		if ($request->has('permissions')) {
			$role->givePermissionTo($request->get('permissions'));
		}

		$message = 'New Role Added.';
		return ($request->get('action') == 'save' ? back() : redirect()->route('role.index'))->with('success', $message);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$role        = Role::findOrFail($id);
		$permissions = Permission::all();

		return view('dashboard.role.edit', compact('role', 'permissions'));
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
			'name'        => 'required|string',
			'permissions' => 'nullable|array|exists:permissions,id',
		]);

		$role = Role::findOrFail($id);

		$role->update(['name' => $request->get('name')]);

		$changedPermission = $request->permissions;
		$revokePermission  = $role->permissions()->get()->except($changedPermission);

		if ($revokePermission->isNotEmpty()) {
			$revokePermission->each(function ($value) use ($role) {
				$value->removeRole($role);
			});
		}

		if ($request->has('permissions')) {
			foreach ($changedPermission as $permission) {
				$permission = Permission::findById($permission);
				if (!$role->hasPermissionTo($permission->name)) {
					$role->givePermissionTo($permission->name);
				}
			}
		}

    $message = 'Role Updated.';
		return ($request->get('action') == 'update' ? back() : redirect()->route('role.index'))->with('success', $message);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$item = Role::find($id);

		if ($item) {
			$item->delete();
			return back()->with('success', 'Role Deleted.');
		} else {
			return back()->with('error', 'Role Not Found.');
		}
	}
}
