<div>
  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Users</li>
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
                        <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Add New User</button>                      
                  </div>
                <div class="card">
                  <div class="card-body">
                      <table class="table table-hover">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Phone</th>
                              <th scope="col">Email</th>
                              <th scope="col">Registred Date</th>
                              <th scope="col">Role</th>
                              <th scope="col"></th>
                            </tr>
                          </thead>
                          <tbody wire:loading.class="text-muted">
                            @forelse ($users as $user)
                              <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td><a><p data-letters="{{$user->name[0]}}"> {{$user->name}}</p></a></td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->toDateString() }}</td>
                                <td>
                                  @if ($user->role === 1)
                                    User
                                  @else
                                    Admin
                                  @endif
                                  </td>
                                <td>
                                      <a href="" wire:click.prevent="edit({{ $user }})">
                                        <i class="fa fa-edit mr-2"></i>
                                      </a>
                                      <a href="" wire:click.prevent="confirmUserRemoval({{ $user->id }})">
                                        <i class="fa fa-trash text-danger"></i>
                                      </a>                                    
                                </td>
                              </tr>
                            @empty
                              <tr>
                                <td colspan="5" class="text-center"><h5>No Results Found</h5></td>
                              </tr>
                            @endforelse
                          </tbody>
                        </table>
                  </div>
                  <div class="card-footer d-flex justify-content-end">
                    {{ $users->links() }}
                  </div>
                </div>
              </div>
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
          <style>
            [data-letters]:before {
              content:attr(data-letters);
              display:inline-block;
              font-size:1em;
              width:2.5em;
              height:2.5em;
              line-height:2.5em;
              text-align:center;
              border-radius:50%;
              background:rgb(160, 199, 221);
              vertical-align:middle;
              margin-right:1em;
              color:white;
              padding-left: 1px;
              }
            </style> 
        </div>
        <!-- /.content -->
  
          <!-- Modal -->
          <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog" role="document">
              <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateUser' : 'createUser' }}">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                    @if ($showEditModal)
                      <span>Edit User</span>  
                    @else
                      <span>Add New User</span>  
                    @endif
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" wire:model.defer="state.name" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="nameHelp" placeholder="Enter full name">
                      @error('name')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="email">Email address</label>
                      <input type="email" wire:model.defer="state.email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                      @error('email')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" wire:model.defer="state.password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                      @error('password')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="passwordConfirmation">Confirm Password</label>
                      <input type="password" wire:model.defer="state.password_confirmation" class="form-control" id="passwordConfirmation" placeholder="Confirm Password">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="number" wire:model.defer="state.phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Phone Number">
                        @error('phone')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    <div class="form-group">
                      <label for="role">Role</label>
                      <select wire:model.defer="state.role" class="form-control">
                          <option>Select Role</option>
                          
                          <option value=1 @if ($user) {{ ($user->role === 1) ? 'selected' : '' }} @endif>User</option>
                          <option value=0 @if ($user) {{ ($user->role === 0) ? 'selected' : '' }} @endif>Admin</option>                      </select>
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
          <!-- Modal -->
          <div class="modal fade" id="confirmationModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5>Delete User</h5>
                  </div>
  
  
                  <div class="modal-body">
                    <h4>Are you sure you want to delete this user?</h4>
                  </div>
  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fa fa-times mr-1"></i> Cancel</button>
                  <button type="button" wire:click.prevent="deleteUser" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete User</button>
                  </div>
                </div>
            </div>
          </div>
  
  
  </div>
  
