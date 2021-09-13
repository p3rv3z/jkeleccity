<?php

namespace App\Http\Livewire\Anywhere;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class AddCustomer extends Component
{
  public $fieldName;
  public $fieldNID; //National ID no
  public $fieldBCN; //Birth Certificate No
  public $fieldPhone;
  public $fieldEmail;
  public $fieldAddress;

  public function render()
  {
    return view('livewire.anywhere.add-customer');
  }

  /**
   * Reset form after submit
   */
  public function resetForm()
  {
    $this->fieldName = null;
    $this->fieldNID = null;
    $this->fieldBCN = null;
    $this->fieldPhone = null;
    $this->fieldEmail = null;
    $this->fieldAddress = null;
  }

  /**
   * Add new Customer from anywhere
   */
  public function addNewCustomerFormSubmit()
  {
    $this->validate([
      'fieldName' => ['required', 'string', 'max:255'],
      'fieldNID' => ['nullable', 'numeric', 'unique:users,nid'],
      'fieldBCN' => ['nullable', 'numeric', 'unique:users,birth_certificate_no'],
      'fieldPhone' => ['required', 'integer', 'digits:10', 'unique:users,phone'],
      'fieldEmail' => ['nullable', 'string', 'email', 'max:255', 'unique:users,email'],
      'fieldAddress' => ['required', 'string', 'max:255']
    ]);

    $newUser = User::create([
      'name' => $this->fieldName,
      'nid' => $this->fieldNID,
      'birth_certificate_no' => $this->fieldBCN,
      'phone' => $this->fieldPhone,
      'email' => $this->fieldEmail,
      'address' => $this->fieldAddress,
      'password' => Hash::make('12345678'),
    ]);
    $newUser->assignRole('Customer');

    $this->resetForm();
    $this->emit('customerAddedFromAnywhere', $newUser->id); //call listener to reload product list
    $this->dispatchBrowserEvent('addedFromAnywhere'); // browser event trigger
    session()->flash('success', 'Customer Added Successfully.');
  }
}
