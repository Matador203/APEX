<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">categories</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">categories</li>
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
                    <div class="d-flex justify-content-end mb-2">
                      <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Add New category</button>
                    </div>
                    
                  <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Image</th>
                                  <th scope="col">Options</th>                                    
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($categories as $category)
                                <tr>
                                  <th scope="row">{{ $loop->iteration }}</th>
                                  <td>{{ $category->title }}</td>
                                  <td>
                                      @if ($category->image)
                                        <img class="img" src="{{ asset('storage/categories/' . $category->image) }}"style="width: 50px;" alt="">
                                      @else
                                      @endif
                                      
                                </td>
                                  <td>
                                   
                                      <a href="" wire:click.prevent="edit({{ $category }})">
                                        <i class="fa fa-edit mr-2"></i>
                                      </a>
                                    
                                    
                                      <a href="" wire:click.prevent="confirmCategoryRemoval({{ $category->id }})">
                                        <i class="fa fa-trash text-danger"></i>
                                      </a>
                                    
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                      {{ $categories->links() }}
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content -->
    
            <!-- Modal -->
            <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
              <div class="modal-dialog" role="document">
                <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateCategory' : 'createCategory' }}">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                      @if ($showEditModal)
                        <span>Edit Category</span>  
                      @else
                        <span>Add New Category</span>  
                      @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" wire:model.defer="state.title" class="form-control @error('title') is-invalid @enderror" id="title" aria-describedby="titleHelp" placeholder="Enter full Title">
                        @error('title')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="custom-file">Background Image</label>
                        
                          <div class="custom-file">
                            <div x-data="{ isUploading: false, progress: 5 }" x-on:livewire-upload-start="isUploading=true" x-on:livewire-upload-finish="isUploading=false; progress = 5"
                            x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress"
                            >
                              <input wire:model.defer="photo" type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" placeholder="image">
                              <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
                                <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`">
                                  <span class="sr-only">40% Complete (success)</span>
                                </div>
                              </div>
                              
                            </div>
                            <label class="custom-file-label" for="image">
                                @if ($photo)
                                    {{ $photo->getClientOriginalName() }}
                                @else
                                    Choose Image
                                @endif
                            </label>

                          </div>
                          @if ($photo)
                              <img src="{{ $photo->temporaryUrl() }}" class="img d-block mt-2 w-100">
                              @else
                              @endif
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
    
    
    
    
          
    
</div> <!-- Modal -->
<div class="modal fade" id="confirmationModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5>Delete Category</h5>
    </div>


    <div class="modal-body">
      <h4>Are you sure you want to delete this category?</h4>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fa fa-times mr-1"></i> Cancel</button>
    <button type="button" wire:click.prevent="deleteCategory" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete Category</button>
    </div>
  </div>
</div>
</div>

</div>