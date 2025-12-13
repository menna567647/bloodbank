@extends('admin.layouts.main')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Card -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-user-edit me-2"></i> {{ __('messages.updateuser') }}
                        </h5>
                    </div>

                    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">

                            <!-- Name -->
                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.name') }}</label>
                                <span class="text-danger">*</span>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="{{ __('messages.name') }}" value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.email') }}</label>
                                <span class="text-danger">*</span>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="{{ __('messages.email') }}" value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Role -->
                            <div>
                                <label class="form-label">{{ __('messages.role') }}</label>
                                <span class="text-danger">*</span>
                                <br>
                                <select name="role_name" class="form-select @error('role_name') is-invalid @enderror">
                                    <option disabled hidden>— {{ __('messages.selectrole') }} —</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}"
                                            {{ $user->roles->first()?->name === $role->name ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Hidden Password Fields to Preserve Old Password -->
                            <input type="hidden" name="password" value="{{ $user->password }}">
                            <input type="hidden" name="password_confirmation" value="{{ $user->password }}">

                        </div>

                        <div class="card-footer bg-light text-end">
                            <button type="submit" class="btn btn-primary text-white">
                                <i class="fas fa-save me-1"></i> {{ __('messages.updateuser') }}
                            </button>
                        </div>
                    </form>
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>
@endsection
