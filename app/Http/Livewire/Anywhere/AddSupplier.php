<?php

namespace App\Http\Livewire\Anywhere;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AddSupplier extends Component
{
  public $fieldName;
  public $fieldPhone;
  public $fieldAddress;
  public $fieldDescription;
  public $fieldEmail;
  public $fieldFaxNumber;
  public $fieldWebsite;

  public function render()
  {
    return view('livewire.anywhere.add-supplier');
  }

  public function resetForm()
  {
    $this->fieldName = null;
    $this->fieldAddress = null;
    $this->fieldDescription = null;
    $this->fieldPhone = null;
    $this->fieldEmail = null;
    $this->fieldFaxNumber = null;
    $this->fieldWebsite = null;
  }

  /**
   * Add new Customer from anywhere
   */
  public function addNewSupplierFormSubmit()
  {
    $this->validate([
      'fieldName' => ['required', 'string', 'max:255'],
      'fieldAddress' => ['required', 'string', 'max:255'],
      'fieldDescription' => ['required', 'string', 'max:255'],
      'fieldPhone' => ['nullable', 'integer', 'digits:10', 'unique:users,phone'],
      'fieldEmail' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
      'fieldFaxNumber' => ['string', 'unique:users,fax'],
      'fieldWebsite' => ['string', 'unique:users,website'],
    ]);

    $newUser = User::create([
      'name' => $this->fieldName,
      'address' => $this->fieldAddress,
      'description' => $this->fieldDescription,
      'phone' => $this->fieldPhone,
      'email' => $this->fieldEmail,
      'fax' => $this->fieldFaxNumber,
      'website' => $this->fieldWebsite,
      'password' => Hash::make('12345678'),
    ]);
    $newUser->assignRole('Supplier');

    $this->resetForm();
    $this->emit('supplierAddedFromAnywhere', $newUser->id); //call listener to reload supplier list
    $this->dispatchBrowserEvent('addedFromAnywhere'); // browser event trigger
    session()->flash('success', 'Supplier Added Successfully.');
  }
}
