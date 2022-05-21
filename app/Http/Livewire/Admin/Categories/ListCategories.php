<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;

class ListCategories extends AdminComponent
{
    use WithFileUploads;

    public $state = [];
    public $category;
    public $photo;
    public $showEditModal = false;
    public $categoryIdBeingRemoved = null;

    public function addNew()
    {

        $this->reset();
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createCategory()
    {
        
        $validatedData = Validator::make($this->state, [
            'title' => 'required',
        ])->validate();

        if ($this->photo) {
            $validatedData['image'] = $this->photo->store('/', 'categories');
        }

        Category::create($validatedData);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'Category added successfully!']);
    }
public function edit(Category $category)
    {
        $this->reset();
        $this->showEditModal = true;
        $this->category = $category;
        $this->state = $category->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateCategory()
    {
        
        $validatedData = Validator::make($this->state, [
            'title' => 'required',
        ])->validate();


        if($this->photo){
            if ($this->category->image !== null) {
                Storage::disk('categories')->delete($this->category->image);
            }
            $validatedData['image'] = $this->photo->store('/', 'categories');
        }


        $this->category->update($validatedData);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'Category updated successfully!']);
    }

    public function confirmCategoryRemoval($categoryId)
    {
        $this->categoryIdBeingRemoved = $categoryId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteCategory()
    {
        $category = Category::findOrFail($this->categoryIdBeingRemoved);

            if ($category->image !== null) {
                Storage::disk('categories')->delete($category->image);
            }
            $category->delete();
            $this->dispatchBrowserEvent('hide-delete-modal', ['message' => "{$category->title} deleted successfully!"]);
    }
    public function render()
    {
        $categories = Category::latest()->paginate(5);
        return view('livewire.admin.categories.list-categories', [
            'categories' => $categories,
        ]);
    }
}