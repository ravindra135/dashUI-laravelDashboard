@extends('layouts.admin')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Roles</li>
        </ol>
        <h5 class="font-weight-bolder mb-0">Role Management</h5>
    </nav>
@stop

@section('content')

    @can('Role access')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h6>Roles</h6>
                            <p class="text-sm mb-0">
                                <i class="fa fa-check text-info" aria-hidden="true"></i>
                                <span class="font-weight-bold ms-1">{{ $roles->count() }}</span> Available
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div id="table" class="table-responsive p-0 navbar-nav-scroll">
                        <table class="table scroller position-relative max-height-vh-100 h-100 align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Roles</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-1">Permissions</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                            </thead>
                            <tbody class="">
                            @foreach($roles as $role)
                                <tr>
                                    <td class="h-auto">
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $role->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-content-center">
                                        @foreach($role->permissions as $permission)
                                            <span style="border-radius: 1em" class="justify-center px-2 py-1 mr-2 text-xs text-bold text-white bg-gray-500">{{ $permission->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="text-center h-auto">
                                        @if(auth()->user()->hasRole($role->name) != $role->name)
                                        <form id="roleDelete" action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            @can('Role edit')
                                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit Role">
                                                <i class="fa-solid fa-wand-magic-sparkles text-secondary"></i>
                                            </a>
                                            @endcan
                                            @can('Role delete')
                                            <button class="cursor-pointer fas fa-trash text-secondary" style="border: none; background: no-repeat;" data-bs-toggle="tooltip" data-bs-original-title="Delete Role"></button>
                                            @endcan
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan

    @can('Role create')
    <div class="row my-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h5 class="mb-0">{{ __('Add New Role') }}</h5>
                </div>
                <div class="card-body pt-4 p-3">
                    <form method="POST" action="{{ route('admin.roles.store') }}" role="form text-left">
                        @csrf
                        @method('POST')
                        <div class="row">
                        <div class="form-group">
                            <label for="name" class="form-control-label">{{ __('Role Name') }}</label>
                            <div class="@error('name')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="text" placeholder="Role Name" id="name" name="name" required>
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
                                ><span class="text-gray-700">{{ $permission->name }}</span>
                                    </li></ul>
                            @endforeach
                            </div>
                        </div>
                        <div class="row">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Add Role' }}</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endcan

@stop

@section('scripts')
    <script>
        new PerfectScrollbar('#table tbody');
    </script>
@stop
