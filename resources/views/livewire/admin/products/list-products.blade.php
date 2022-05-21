<div>
   <!-- Content Header (Page header) -->
   <div class="content-header">
       <div class="container-fluid">
         <div class="row mb-2">
           <div class="col-sm-6">
             <h1 class="m-0">Products</h1>
           </div><!-- /.col -->
           <div class="col-sm-6">
             <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
               <li class="breadcrumb-item active">Products</li>
             </ol>
           </div><!-- /.col -->
         </div><!-- /.row -->
       </div><!-- /.container-fluid -->
     </div>
     <!-- /.content-header -->
   
       <!-- Main content -->
       <div class="content">
           <div class="container-fluid">
             <div class="row">
               <div class="col-lg-12">
                   <div class="d-flex justify-content-between mb-2">
                     <x-search-input wire:model="searchTerm"/>
                         <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Add New Product</button>
                   </div>
                 <div class="card">
                   <div class="card-body">
                       <table class="table table-hover">
                           <thead>
                             <tr>
                               <th scope="col">#</th>
                               <th scope="col">Title</th>
                               <th scope="col">Category</th>
                               <th scope="col">Price</th>
                               <th scope="col">Qty</th>
                               <th scope="col">Image</th>
                               <th scope="col">Options</th>
                             </tr>
                           </thead>
                           <tbody wire:loading.class="text-muted">
                             @forelse ($products as $product)
                               <tr>
                                   <th scope="row">{{ $product->id }}</th>
                                       <td>{{ $product->title }}</td>
                                       <td>{{ $product->category->title  }}</td>
                                       <td>{{ $product->quantity  }}</td>
                                       <td>{{ $product->price  }}</td>
                                       <td>
                                           <img class="img" src="{{ asset('storage/products/' . $product->image1) }}"style="width: 50px;" alt="">
                                       </td>
                                       <td>
                                           <a href="" wire:click.prevent="edit({{ $product }})">
                                              <i class="fa fa-edit mr-2"></i>
                                           </a>
                                           <a href="" wire:click.prevent="confirmProductRemoval({{ $product->id }})">
                                              <i class="fa fa-trash text-danger"></i>
                                           </a>                                             
                                       </td>
                               </tr>
                             @empty
                               <tr>
                                 <td colspan="7" class="text-center"><h5>No Products Found</h5></td>
                               </tr>
                             @endforelse
                           </tbody>
                         </table>
                   </div>
                   <div class="card-footer d-flex justify-content-end">
                     {{ $products->links() }}
                   </div>
                 </div>
               </div>
             </div>
             <!-- /.row -->
           </div><!-- /.container-fluid -->
         </div>
         <!-- /.content -->
   
           <!-- Modal -->
           <div class="modal fade bd-example-modal-lg" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
             <div class="modal-dialog modal-lg" role="document">
               <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateProduct' : 'createProduct' }}">
               <div class="modal-content">
                 <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">
                     @if ($showEditModal)
                       <span>Edit Product</span>  
                     @else
                       <span>Add New Product</span>  
                     @endif
                   </h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                 </div>
                 <div class="modal-body">
                     <div class="row">
                       <div class="col-12">
                           <label for="category">Category</label>
                           <select wire:model.defer="state.category_id" class="form-control  @error('category_id') is-invalid @enderror">
                             @if (!$showEditModal)
                             <option >Select category</option>
                             @endif
                             @foreach ($categories as $category)
                               <option value="{{$category->id}}" {{ ($category->id == 'state.category_id') ? 'selected' : '' }}>{{$category->title}}</option>
                             @endforeach
                           </select>
                           @error('category_id')
                             <div class="invalid-feedback">
                             {{ $message }}
                             </div>
                           @enderror
                         </div>
                       </div>
                  
                                   <div class="form-group">
                                     <label for="material">Title</label>
                                     <input material="text" wire:model.defer="state.title" class="form-control @error('title') is-invalid @enderror" id="title" aria-describedby="nameHelp" placeholder="Enter new product title">
                                     @error('title')
                                       <div class="invalid-feedback">
                                         {{ $message }}
                                       </div>
                                     @enderror
                               </div>
                               <div class="row">
                                 <div class="col-6">
                                   <label for="material">Price</label>
                                   <div class="input-group">
                                       <div class="input-group-prepend">
                                         <span class="input-group-text">$</span>
                                       </div>
                                       <input type="number" step="0.00001" wire:model.defer="state.price" class="form-control @error('price') is-invalid @enderror" placeholder="Enter price">
                                     </div>
                                     @error('price')
                                           <div class="invalid-feedback">
                                             {{ $message }}
                                           </div>
                                       @enderror
                                   </div>  
                                   <div class="col-6">
                                     <label for="material">Qty</label>
                                     <div class="input-group">
                                         <input type="number" step="1" wire:model.defer="state.quantity" class="form-control @error('quantity') is-invalid @enderror" placeholder="Enter quantity">
                                     </div>
                                       @error('quantity')
                                             <div class="invalid-feedback">
                                               {{ $message }}
                                             </div>
                                         @enderror
                                     </div>  
                               </div>
                                   <div class="form-group">
                                       <label for="material">description</label>
                                       <textarea material="text" wire:model.defer="state.description" class="form-control @error('description') is-invalid @enderror" rows="2" placeholder="Enter description"></textarea>
                                       @error('description')
                                         <div class="invalid-feedback">
                                           {{ $message }}
                                         </div>
                                       @enderror
                                     </div>                      
                                     <div class="row">
                                         <div class="col-4">
                                           <div class="form-group">
                                               <label for="custom-file">Main Image</label>
                                               
                                                 <div class="custom-file">
                                                   <div x-data="{ isUploading: false, progress: 5 }" x-on:livewire-upload-start="isUploading=true" x-on:livewire-upload-finish="isUploading=false; progress = 5"
                                                   x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress"
                                                   >
                                                     <input @if(!$showEditModal) required @endif wire:model.defer="image1" type="file" class="custom-file-input @error('image1') is-invalid @enderror" id="image" placeholder="image">
                                                     <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
                                                       <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`">
                                                         <span class="sr-only">40% Complete (success)</span>
                                                       </div>
                                                     </div>
                                                     
                                                   </div>
                                                   <label class="custom-file-label" for="image">
                                                     @if ($image1)
                                                         {{ $image1->getClientOriginalName() }}
                                                     @else
                                                         Choose Image
                                                     @endif
                                                 </label>
                 
                                               </div>
                                               @if ($image1)
                                                   <img src="{{ $image1->temporaryUrl() }}" class="img d-block mt-2 w-100">
                                                   @else
                                                   @endif
                                               </div>
                                         </div>

                                         <div class="col-4">
                                           <div class="form-group">
                                               <label for="custom-file">Image View</label>
                                               
                                                 <div class="custom-file">
                                                   <div x-data="{ isUploading: false, progress: 5 }" x-on:livewire-upload-start="isUploading=true" x-on:livewire-upload-finish="isUploading=false; progress = 5"
                                                   x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress"
                                                   >
                                                     <input  wire:model.defer="image2" type="file" class="custom-file-input @error('image2') is-invalid @enderror" id="image2" placeholder="image2">
                                                     <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
                                                       <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`">
                                                         <span class="sr-only">40% Complete (success)</span>
                                                       </div>
                                                     </div>
                                                     
                                                   </div>
                                                   <label class="custom-file-label" for="image">
                                                     @if ($image2)
                                                         {{ $image2->getClientOriginalName() }}
                                                     @else
                                                         Choose Image
                                                     @endif
                                                 </label>
                 
                                               </div>
                                               @if ($image2)
                                                   <img src="{{ $image2->temporaryUrl() }}" class="img d-block mt-2 w-100">
                                                   @else
                                                   @endif
                                               </div>
                                         </div>
                                         
                                         <div class="col-4">
                                           <div class="form-group">
                                               <label for="custom-file">Image View</label>
                                               
                                                 <div class="custom-file">
                                                   <div x-data="{ isUploading: false, progress: 5 }" x-on:livewire-upload-start="isUploading=true" x-on:livewire-upload-finish="isUploading=false; progress = 5"
                                                   x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress"
                                                   >
                                                     <input  wire:model.defer="image3" type="file" class="custom-file-input @error('image3') is-invalid @enderror" id="image3" placeholder="image3">
                                                     <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
                                                       <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`">
                                                         <span class="sr-only">40% Complete (success)</span>
                                                       </div>
                                                     </div>
                                                     
                                                   </div>
                                                   <label class="custom-file-label" for="image">
                                                     @if ($image3)
                                                         {{ $image3->getClientOriginalName() }}
                                                     @else
                                                         Choose Image
                                                     @endif
                                                 </label>
                 
                                               </div>
                                               @if ($image3)
                                                   <img src="{{ $image3->temporaryUrl() }}" class="img d-block mt-2 w-100">
                                                   @else
                                                   @endif
                                                </div>
                                         </div>
                                     </div>
                                     
                                 
                 </div>
                 
                 <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fa fa-times mr-1"></i> Cancel</button>
                   <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i> 
                     @if ($showEditModal)
                       <span>Save Changes</span> 
                     @else
                       <span>Save
                         
                       </span> 
                     @endif
                   </button>
                 </div>
               </div>
             </form>
             </div>
           </div>
   
   
   






           <!--Delete Product Modal -->
           <div class="modal fade" id="confirmationModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                       <h5>Delete Product</h5>
                     </div>
     
     
                     <div class="modal-body">
                       <h4>Are you sure you want to delete this Product?</h4>
                     </div>
   
                     <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fa fa-times mr-1"></i> Cancel</button>
                       <button type="button" wire:click.prevent="deleteProduct" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete Product</button>
                     </div>
                 </div>
             </div>
           </div>  
   
   </div>