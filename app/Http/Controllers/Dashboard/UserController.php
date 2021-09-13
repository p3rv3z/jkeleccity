<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return View
   */
  public function index()
  {
    $this->checkPermission('user.index');

    $users = User::when(request()->has('search'), function ($query) {
      return $query->where('name', 'like', '%' . request()->get('search') . '%');
    })->with('roles')->orderBy('id', $this->defaultOrderBy)->paginate(10);
    $this->putSL($users);
    return view('dashboard.user.index', compact('users'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return View
   */
  public function create()
  {
    $this->checkPermission('user.create');

    $roles = $this->roles();
    return view('dashboard.user.create', compact('roles'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function store(Request $request)
  {
    $this->checkPermission('user.create');

    $this->validate($request, [
      'name'     => ['required', 'string', 'max:255'],
      'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', new Password(), 'confirmed'],
      'phone'    => ['nullable', 'integer', 'digits:10', 'unique:users'],
      'fax'      => ['nullable', 'string', 'unique:users'],
      'website'  => ['nullable', 'string'],
      'role'     => ['required', 'string', Rule::notIn(['Super Admin']), 'exists:roles,name'],
      'status'   => ['required', 'boolean'],
      'action'   => ['required', Rule::in(['save', 'save&close'])],
    ]);

    $newUser = User::create([
      'name'     => $request->get('name'),
      'email'    => $request->get('email'),
      'password' => Hash::make($request->get('password')),
      'phone'    => $request->get('phone'),
      'fax'      => $request->get('fax'),
      'website'  => $request->get('website'),
      'status'   => $request->get('status'),
    ]);
    $newUser->assignRole($request->get('role'));

    $message = 'User successfully added.';
    return ($request->get('action') === 'save' ? redirect()->back() : redirect()->route('user.index'))->with('success', $message);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param User $user
   * @return RedirectResponse|View
   */
  public function edit(User $user)
  {
    $this->checkPermission('user.edit');

    if ($user->hasRole('Super Admin')) {
      return back()->with('warning', 'Super user can\'t be deletable.');
    }

    $roles = $this->roles();

    return view('dashboard.user.edit', compact('user', 'roles'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param User $user
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function update(Request $request, User $user)
  {
    $this->checkPermission('user.edit');

    if ($user->hasRole('Super Admin')) {
      return back()->with('warning', 'Super user can\'t be deletable.');
    }

    $this->validate($request, [
      'name'    => ['required', 'string', 'max:255'],
      'email'   => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
      'phone'   => ['nullable', 'integer', 'digits:10', 'unique:users,phone,' . $user->id],
      'fax'     => ['nullable', 'string', 'unique:users,fax,' . $user->id],
      'website' => ['nullable', 'string'],
      'role'    => ['required', 'string', Rule::notIn(['Super Admin']), 'exists:roles,name'],
      'status'  => ['required', 'boolean'],
      'action'  => ['required', Rule::in(['update', 'update&close'])],
    ]);

    $user->update([
      'name'    => $request->get('name'),
      'email'   => $request->get('email'),
      'phone'   => $request->get('phone'),
      'fax'     => $request->get('fax'),
      'website' => $request->get('website'),
      'status'  => $request->get('status'),
    ]);

    $newRole = $request->get('role');
    if (!$user->hasRole($newRole)) {
      $user->syncRoles($newRole);
    }

    $message = 'User information successfully updated.';
    return ($request->get('action') === 'update' ? redirect()->back() : redirect()->route('user.index'))->with('success', $message);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param User $user
   * @return RedirectResponse
   * @throws Exception
   */
  public function destroy(User $user)
  {
    $this->checkPermission('user.delete');

    if ($user->hasRole('Super Admin')) {
      return back()->with('warning', 'Super user can\'t be deletable.');
    }

    $user->roles()->detach();
    $user->delete();
    return back()->with('success', 'User successfully deleted.');
  }
}
