@extends('layouts.app') {{-- Or an admin specific layout --}}

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit User: {{ $user->name }}</div>

                <div class="panel-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.users.update', $user->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }} {{-- or PUT --}}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            <label for="role" class="col-md-4 control-label">Role</label>
                            <div class="col-md-6">
                                <select id="role" name="role" class="form-control" required>
                                    <option value="client" {{ old('role', $user->role) == 'client' ? 'selected' : '' }}>Client</option>
                                    <option value="lawyer" {{ old('role', $user->role) == 'lawyer' ? 'selected' : '' }}>Lawyer</option>
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @if ($errors->has('role'))
                                    <span class="help-block"><strong>{{ $errors->first('role') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        {{-- Fields specific to Lawyer role --}}
                        <div id="lawyer_fields" style="{{ old('role', $user->role) == 'lawyer' ? '' : 'display:none;' }}">
                            <div class="form-group{{ $errors->has('specialization') ? ' has-error' : '' }}">
                                <label for="specialization" class="col-md-4 control-label">Specialization</label>
                                <div class="col-md-6">
                                    <textarea id="specialization" class="form-control" name="specialization">{{ old('specialization', $user->specialization) }}</textarea>
                                    @if ($errors->has('specialization'))
                                        <span class="help-block"><strong>{{ $errors->first('specialization') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="verified" class="col-md-4 control-label">Verified Lawyer</label>
                                <div class="col-md-6">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="verified" value="1" {{ old('verified', $user->verified) ? 'checked' : '' }}>
                                            Yes
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update User
                                </button>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-default">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts') {{-- This assumes a @stack('scripts') in the layout file --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    var roleSelect = document.getElementById('role');
    var lawyerFields = document.getElementById('lawyer_fields');

    function toggleLawyerFields() {
        if (roleSelect.value === 'lawyer') {
            lawyerFields.style.display = '';
        } else {
            lawyerFields.style.display = 'none';
        }
    }

    roleSelect.addEventListener('change', toggleLawyerFields);
    // toggleLawyerFields(); // Call on load if not already handled by old() value
});
</script>
@endpush
