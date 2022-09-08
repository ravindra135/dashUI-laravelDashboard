@extends('layouts.admin')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('admin.roles.index') }}">Roles</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit Role</li>
        </ol>
        <h5 class="font-weight-bolder mb-0">Role Management</h5>
    </nav>
@stop

@section('content')
<div class="row my-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h5 class="mb-0">{{ __('Edit Role') }}</h5>
            </div>
            <div class="card-body pt-4 p-3">
                <form method="POST" action="{{ route('admin.roles.update', $role->id) }}" role="form text-left">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group">
                            <label for="name" class="form-control-label">{{ __('Role Name') }}</label>
                            <div class="@error('name')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="text" value="{{ $role->name }}" placeholder="Role Namne" id="name" name="name">
                                @error('name')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-control-label">{{ __('Attach Permissions') }}</label>
                        <div class="grid grid-cols-3 gap-4">
                            @foreach($permissions as $permission)
                                <ul style="display: block; float: left; width: 25%; list-style: none">  <li>
                                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="permissions[]" value="{{$permission->id}}"
                                               @if(count($role->permissions->where('id',$permission->id)))
                                               checked
                                            @endif
                                        ><span class="text-gray-700">{{ $permission->name }}</span>
                                    </li></ul>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;{{ 'Update Role' }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
