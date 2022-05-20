<?php

namespace App\Http\Livewire\Admin\Suppliers;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Supplier;
use Illuminate\Support\Facades\Validator;
class ListSuppliers extends AdminComponent
{
    public $state = [];
    public $supplier;
    public $showEditModal = false;
    public $userIdBeingRemoved = null;
    public $searchTerm = null;
    protected $queryString = ['searchTerm' => ['except' => '']];
    public function addNew()
    {
        $this->state = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }
    public function createSupplier()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
        ])->validate();

        
        $supplier = Supplier::create($validatedData);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Supplier added successfully!']);
    }
    public function edit(Supplier $supplier)
    {
        $this->showEditModal = true;
        $this->supplier = $supplier;
        $this->state = $supplier->toArray();
        $this->dispatchBrowserEvent('show-form');
    }
    public function updateSupplier()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->supplier->id,
            'phone' => 'required',
        ])->validate();


        
        $this->supplier->update($validatedData);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Supplier updated successfully!']);
    }
    public function confirmSupplierRemoval($supplierId)
    {
        $this->userIdBeingRemoved = $supplierId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }
    public function deleteSupplier()
    {
            $user = Supplier::findOrFail($this->userIdBeingRemoved);
            $user->delete();
            $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Supplier deleted successfully!']);
        
        
    }
    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function render()
    {
        $suppliers = Supplier::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->latest()->paginate(5);
        return view('livewire.admin.suppliers.list-suppliers', [
            'suppliers' => $suppliers,
        ]);
    }
}