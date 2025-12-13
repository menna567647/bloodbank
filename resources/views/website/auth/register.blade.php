@extends('website.layouts.main', [
    'bodyClass' => 'create',
])
@section('content')
    <!--form-->
    <div class="form">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('website.page') }}">{{ __('messages.home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('messages.register') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="account-form">
                <form method="post" action="{{ route('website.register.submit') }}">
                    @csrf

                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" aria-describedby="emailHelp" placeholder="{{ __('messages.name') }}"
                        value="{{ old('name') }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" aria-describedby="emailHelp" placeholder="{{ __('messages.email') }}"
                        value="{{ old('email') }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <input placeholder="{{ __('messages.dateofbirth') }}"
                        class="form-control @error('dob') is-invalid @enderror" type="text" onfocus="(this.type='date')"
                        id="dob" name="dob" value="{{ old('dob') }}">
                    @error('dob')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <select class="form-control @error('blood_type_id') is-invalid @enderror" id="blood_type_id"
                        name="blood_type_id">
                        <option value="" selected>{{ __('messages.bloodtype') }}</option>
                        @foreach ($bloodTypes as $item)
                            <option value="{{ $item->id }}" {{ old('blood_type_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('blood_type_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <select class="form-control @error('governrate_id') is-invalid @enderror" id="governrate"
                        name="governrate_id">
                        <option value="" selected disabled>{{ __('messages.Governorate') }}</option>
                        @foreach ($governrates as $item)
                            <option value="{{ $item->id }}" {{ old('governrate_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('governrate_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <select class="form-control @error('city_id') is-invalid @enderror" id="city" name="city_id">
                        <option value="" selected disabled>{{ __('messages.city') }}</option>
                    </select>
                    @error('city_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                        name="phone" aria-describedby="emailHelp" placeholder="{{ __('messages.phone') }}"
                        value="{{ old('phone') }}">
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <input placeholder="{{ __('messages.last_donation_date') }}"
                        class="form-control @error('last_donation_date') is-invalid @enderror" type="text"
                        onfocus="(this.type='date')" id="last_donation_date" name="last_donation_date"
                        value="{{ old('last_donation_date') }}">
                    @error('last_donation_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                        id="exampleInputPassword1" name="password" placeholder="{{ __('messages.password') }}">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <input type="password" class="form-control" id="exampleInputPassword1" name="password_confirmation"
                        placeholder="{{ __('messages.passwordconfirmation') }}">

                    <div class="create-btn">
                        <input type="submit" value="{{ __('messages.create') }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#governrate').on('change', function() {
            var governrate_id = $(this).val();

            if (governrate_id) {
                $.ajax({
                    url: '/get-cities/' + governrate_id,
                    type: 'GET',
                    success: function(data) {
                        $('#city').empty();
                        $('#city').append(
                            '<option selected disabled>{{ __('messages.selectcity') }}</option>');
                        $.each(data, function(key, value) {
                            $('#city').append('<option value="' + value.id + '">' + value.name +
                                '</option>');
                        });
                    }
                });
            } else {
                $('#city').empty();
            }
        });
    </script>
@endpush