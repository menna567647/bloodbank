@extends('admin.layouts.main')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Card -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-user-plus me-2"></i> {{ __('messages.adduser') }}
                        </h5>
                    </div>

                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf
                        <div class="card-body">

                            <!-- Name -->
                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.name') }}</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" placeholder="{{ __('messages.name') }}" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.email') }}</label>
                                <span class="text-danger">*</span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" placeholder="{{ __('messages.email') }}" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.password') }}</label>
                                <span class="text-danger">*</span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" placeholder="{{ __('messages.password') }}">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password Confirmation -->
                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.passwordconfirmation') }}</label>
                                <span class="text-danger">*</span>
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="{{ __('messages.passwordconfirmation') }}">
                            </div>

                            <!-- Role -->
                            <div>
                                <label class="form-label">{{ __('messages.role') }}</label>
                                <span class="text-danger">*</span>
                                <br>
                                <select name="role_name" id="role_name"
                                    class="form-select @error('role_name') is-invalid @enderror">
                                    <option></option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}"
                                            {{ old('role_name') == $role->name ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="card-footer text-end bg-light">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-user-plus me-1"></i> {{ __('messages.adduser') }}
                            </button>
                        </div>
                    </form>
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>
@endsection
