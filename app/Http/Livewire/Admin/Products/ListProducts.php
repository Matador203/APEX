<?php

namespace App\Http\Livewire\Admin\Products;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use App\Http\Livewire\Admin\AdminComponent;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Models\Category;

class ListProducts extends AdminComponent
{
    use WithFileUploads;
    public $categories;

    public $selectedCategory = NULL;

    public $state = [];

    //variables names for images used in add and edit 
    public $image1;
    public $image2;
    public $image3;

    public $product;
    public $showEditModal = false;
    public $productIdBeingRemoved = null;
    public $searchTerm = null;
    protected $queryString = ['searchTerm' => ['except' => '']];

    

    public function mount()
    {
        $this->categories = Category::all();
    }
    public function addNew()
    {

        $this->image1 = NULL;
        $this->image2 = NULL;
        $this->image3 = NULL;
        $this->selectedCategory = NULL;
        
        $this->state = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createProduct()
    {    
        $validatedData = Validator::make($this->state, [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',

        ])->validate();
        if ($this->image1) {
            $validatedData['image1'] = $this->image1->store('/', "products");
        }
        if ($this->image2) {
            $validatedData['image2'] = $this->image2->store('/', "products");
        }
        if ($this->image3) {
            $validatedData['image3'] = $this->image3->store('/', "products");
        }
        Product::create($validatedData);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'Product added successfully!']);
        $this->image1 = NULL;
        $this->image2 = NULL;
        $this->image3 = NULL;
        $this->selectedCategory = NULL;
    }

    public function edit(Product $product)
    {
        $this->image1 = NULL;
        $this->image2 = NULL;
        $this->image3 = NULL;
        $this->selectedCategory = NULL;
        $this->showEditModal = true;
        $this->product = $product;
        $this->state = $product->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateProduct()
    {

        $validatedData = Validator::make($this->state, [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
        ])->validate();
        
        if($this->image1){
            Storage::disk('products')->delete($this->product->image1);
            $validatedData['image1'] = $this->image1->store('/', 'products');
        }
        if($this->image2){
            if ($this->product->image2 !== null){
                Storage::disk('products')->delete($this->product->image2);
            }
            $validatedData['image2'] = $this->image2->store('/', 'products');
        }
        if($this->image3){
            if ($this->product->image3 !== null){
                Storage::disk('products')->delete($this->product->image3);
            }
            $validatedData['image3'] = $this->image3->store('/', 'products');
        }
        $this->product->update($validatedData);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Product updated successfully!']);
    }

    public function confirmProductRemoval($productId)
    {
        $this->productIdBeingRemoved = $productId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteProduct()
    {

        $product = Product::findOrFail($this->productIdBeingRemoved);
        
            if ($product->image1 !== null){
                Storage::disk('products')->delete($product->image1);
            }
            if ($product->image2 !== null){
                Storage::disk('products')->delete($product->image2);
            }
            if ($product->image3 !== null){
                Storage::disk('products')->delete($product->image3);
            }
            $product->delete();
            $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Product deleted successfully!']);
        
    }
    public function updatedSearchTerm()
    {
        $this->resetPage();
    }
    public function render()
    {
        $products = Product::query()
        ->where('title', 'like', '%' . $this->searchTerm . '%')
        ->latest()->paginate(7);
        $categories = Category::all();
        return view('livewire.admin.products.list-products', [
            'products' => $products,
            'categories' => $categories,
        ]);
        
    }
}