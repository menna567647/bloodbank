@extends('website.layouts.main')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-4">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-primary text-white rounded-top-4">
                        <h5 class="mb-0"><i class="fa-solid fa-user-pen me-2"></i>{{ __('messages.UPDATEMYPROFILE') }}</h5>
                    </div>
                    <div class="card-body bg-light">
                        <form action="{{ route('website.profile.update') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.bloodtype') }}</label>
                                <input type="text" readonly class="form-control" value="{{ $user->bloodType->name }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.email') }}</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.phone') }}</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', $user->phone) }}">
                                @error('phone')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.last_donation_date') }}</label>
                                <input type="text" name="last_donation_date" class="form-control"
                                    value="{{ old('last_donation_date', $user->last_donation_date) }}">
                                @error('last_donation_date')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100 fw-semibold">
                                {{ __('messages.update') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-header bg-danger text-white rounded-top-4">
                        <h5 class="mb-0"><i class="fa-solid fa-user-xmark me-2"></i>{{ __('messages.DELETEMYACCOUNT') }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('website.profile.delete') }}" method="POST"
                            onsubmit="return confirm('هل أنت متأكد أنك تريد حذف حسابك؟ لا يمكن التراجع عن هذا!');">
                            @csrf
                            @method('delete')
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control form-control-sm"
                                    placeholder="Enter Your Password">
                                @if ($errors->userDeletion->has('password'))
                                    <div class="text-danger mt-1">
                                        {{ $errors->userDeletion->first('password') }}
                                    </div>
                                @endif

                            </div>
                            <button type="submit" class="btn btn-danger btn-sm w-100">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
