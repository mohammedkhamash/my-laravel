@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>User Management App</h1>
        <div class="offset-md-2 col-md-8">
            <div class="card">
                
                @if (isset($user))
                <div class="card-header">
                    Update User
                </div>
                <div class="card-body">
                    <form action="/user-update" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        
                        <div class="mb-3">
                            <label for="user-name" class="form-label">User Name</label>
                            <input type="text" name="name" id="user-name" class="form-control" value="{{ $user->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="user-email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="user-email" class="form-control" value="{{ $user->email }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="user-password" class="form-label">Password</label>
                            <input type="password" name="password" id="user-password" class="form-control">
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save me-2"></i>Update User
                            </button>
                        </div>
                    </form>
                </div>

                @else
                
                <div class="card-header">
                    New User
                </div>
                <div class="card-body">
                    <form action="user-create" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="user-name" class="form-label">User Name</label>
                            <input type="text" name="name" id="user-name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="user-email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="user-email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="user-password" class="form-label">Password</label>
                            <input type="password" name="password" id="user-password" class="form-control" required>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus me-2"></i>Add User
                            </button>
                        </div>
                    </form>
                </div>
                @endif
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    Current Users
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $single_user)
                            <tr>
                                <td>{{ $single_user->name }}</td>
                                <td>{{ $single_user->email }}</td>
                                <td>
                                    <form action="/user-delete/{{ $single_user->id }}" method="POST" class="d-inline">
                                        @csrf  
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash me-2"></i>Delete
                                        </button>
                                    </form>
                                    
                                    <form action="/user-edit/{{ $single_user->id }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-info btn-sm">
                                            <i class="fa fa-edit me-2"></i>Edit
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection