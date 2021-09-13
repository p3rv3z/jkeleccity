<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  protected $itemPerPage    = 10;
  protected $defaultOrderBy = 'desc';

  /**
   * A Function to PUT a sl number with Collection of data.
   *
   * @param $collection - A collection of data collected with paginate function
   * @return void
   */
  public function putSL($collection)
  {
    $start = ($collection->currentPage() * $this->itemPerPage - $this->itemPerPage) + 1;
    $collection->each(function ($value) use (&$start) {
      $value->sl = $start++;
    });

    // Checking pagination need or not and putting to collection
    $collection->hasPagination = $collection->total() > $collection->perPage();
  }

  /**
   * Getting website all role conditionally
   *
   * @return Role - All roles without 'Super Admin'
   */
  public function roles()
  {
    return Role::where('name', '!=', 'Super Admin')->get();
  }

  /**
   * Permission check function
   *
   * @param string $permission
   * @param string $message - response message
   * @return void
   */
  public function checkPermission(string $permission, $message = "Permission denied.")
  {
    abort_if(!Auth::user()->can($permission), 403, $message);
  }
}
