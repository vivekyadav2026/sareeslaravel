@extends('layouts.admin')

@section('title', 'Edit Role')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0 fw-bold">Edit Role - {{ $role->name }}</h5>
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

                <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="name" class="form-label fw-semibold">Role Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $role->name) }}" placeholder="e.g. Sales Manager" required {{ $role->name === 'Super Admin' ? 'disabled' : '' }}>
                        @if($role->name === 'Super Admin')
                            <input type="hidden" name="name" value="Super Admin">
                            <small class="text-muted">The name of the Super Admin role cannot be modified.</small>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold mb-3">Assign Permissions</label>
                        @if($role->name === 'Super Admin')
                            <div class="alert alert-info border-0 bg-info bg-opacity-10 text-info">
                                <i class="fas fa-info-circle me-2"></i> The Super Admin role inherently holds all system permissions.
                            </div>
                        @else
                            <div class="row">
                                @foreach($permissions as $permission)
                                    <div class="col-md-4 col-sm-6 mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="perm_{{ $permission->id }}" {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                            <label class="form-check-label text-capitalize" for="perm_{{ $permission->id }}">
                                                {{ str_replace('_', ' ', $permission->name) }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-end gap-2 border-top pt-4">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
