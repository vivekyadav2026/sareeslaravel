@extends('layouts.admin')

@section('title', 'Create Role')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0 fw-bold">Add New Role</h5>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger border-0 bg-danger bg-opacity-25 text-white rounded-3 mb-4">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.roles.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="form-label fw-semibold">Role Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. Sales Manager" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold mb-3">Assign Permissions</label>
                        <div class="row">
                            @foreach($permissions as $permission)
                                <div class="col-md-4 col-sm-6 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="perm_{{ $permission->id }}">
                                        <label class="form-check-label text-capitalize" for="perm_{{ $permission->id }}">
                                            {{ str_replace('_', ' ', $permission->name) }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 border-top pt-4">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Create Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
