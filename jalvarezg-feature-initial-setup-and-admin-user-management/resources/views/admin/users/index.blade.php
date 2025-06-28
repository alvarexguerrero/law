@extends('layouts.app') {{-- Or an admin specific layout if we create one --}}

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Panel - User Management</div>

                <div class="panel-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <h3>All Users</h3>
                    {{-- Add a link to create users if needed: <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add New User</a> --}}
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Specialization</th>
                                <th>Verified (Lawyer)</th>
                                <th>Registered At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ ucfirst($user->role) }}</td>
                                    <td>{{ $user->specialization ?: 'N/A' }}</td>
                                    <td>
                                        @if($user->isLawyer())
                                            {{ $user->verified ? 'Yes' : 'No' }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-xs btn-info">Edit</a>
                                        {{-- Add delete form/button if needed --}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="text-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
