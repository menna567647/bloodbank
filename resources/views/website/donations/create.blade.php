@extends('website.layouts.main', [
    'bodyClass' => 'inside-request',
])
@section('content')
    <div class="container mt-3">
        <div class="row">
            <!-- left column -->
            <div class="col-md-10 m-auto">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('messages.createdonationrequest') }}</h3>
                    </div>
                    <form method="post" action="{{ route('website.donation.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{ __('messages.patient_name') }} </label>
                                <input type="text" class="form-control" name="patient_name"
                                    placeholder="Enter Patient Name" value="{{ old('patient_name') }}">
                            </div>
                            @error('patient_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label>{{ __('messages.patient_age') }} </label>
                                <input type="text" class="form-control" name="patient_age"
                                    placeholder="Enter Patient Age" value="{{ old('patient_age') }}">
                            </div>
                            @error('patient_age')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label>{{ __('messages.patient_phone') }} </label>
                                <input type="text" class="form-control" name="patient_phone"
                                    placeholder="Enter Patient Phone" value="{{ old('patient_phone') }}">
                            </div>
                            @error('patient_phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label>{{ __('messages.blood_type') }} </label>
                                <select name="blood_type_id" id="blood_type_id" class="form-control">
                                    <option></option>
                                    @foreach ($bloodTypes as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('blood_type_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('blood_type_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label>{{ __('messages.number_of_bags') }} </label>
                                <input type="text" class="form-control" name="number_of_bags"
                                    placeholder="Enter The Number Of Bags" value="{{ old('number_of_bags') }}">
                            </div>
                            @error('number_of_bags')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label>{{ __('messages.city') }} </label>
                                <select name="city_id" id="city_id" class="form-control">
                                    <option></option>
                                    @foreach ($cities as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('city_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('city_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label>{{ __('messages.hospitalname') }}</label>
                                <input type="text" class="form-control" name="hospital_name"
                                    placeholder="Enter Hospital Name" value="{{ old('hospital_name') }}">
                            </div>
                            @error('hospital_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label>{{ __('messages.notes') }} </label>
                                <textarea class="form-control" name="notes" rows="3">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{ __('messages.create') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
