@extends('layouts.admin')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Users</li>
        </ol>
        <h5 class="font-weight-bolder mb-0">User Management</h5>
    </nav>
@stop

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6>All Users</h6>
                        </div>
                        <div class="col-6 text-end">
                            <a class="btn bg-gradient-dark mb-0" href="{{ route('admin.users.create') }}"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add User</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Phone</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Since</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <!-- If User as Image it show up if not then a random picture will be displayed -->
                                            <img src="{{ $user->avatar ?? $user->defAvatar($user->id) }}" class="avatar avatar-sm me-3" alt="avatar">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                            <p class="text-xs text-secondary mb-0">{{ $user->username ? '@' . $user->username : '' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-secondary text-xs font-weight-bold">{{ $user->email }}</span>
                                </td>
                                <td>
                                    <span class="text-secondary text-xs font-weight-bold">{{ $user->phone ? '+'.$user->phone : '---' }}</span>
                                </td>
                                <td>
                                    @foreach($user->roles as $role)
                                        <span class="text-secondary text-xs font-weight-bold">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td class="align-middle text-center text-sm">
                                    @if($user->is_active == 0)
                                        <span class="badge badge-sm bg-gradient-secondary">InActive</span>
                                    @else
                                        <span class="badge badge-sm bg-gradient-success">ACTIVE</span>
                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $user->created_at->format('d-m-Y') }}</span>
                                </td>
                                <td class="align-middle">
                                    @foreach($user->roles as $role)
                                        @if(auth()->user()->id != $user->id)
                                        <form id="userDelete" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            @can('User edit')
                                            <a href="{{ route('admin.users.edit', $user->id) }}" @if(auth()->user()->hasRole($role->name)) hidden @endif class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                                <i class="fas fa-user-edit text-secondary"></i>
                                            </a>
                                            @endcan
                                            @can('User delete')
                                                <button class="cursor-pointer fas fa-trash text-secondary" style="border: none; background: no-repeat;" data-bs-toggle="tooltip" @if(auth()->user()->hasRole($role->name)) hidden @endif data-bs-original-title="Delete User"></button>
                                            @endcan
                                        </form>
                                        @endif
                                    @endforeach
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
@stop
