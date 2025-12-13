@extends('website.layouts.main', [
    'bodyClass' => 'inside-request',
])
@section('content')
    <div class="container mt-3">
        <div class="row">
            <!-- left column -->
            <div class="col-md-8 m-auto">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('messages.editdonationrequest') }}</h3>
                    </div>
                    <form method="post" action="{{ route('website.donation.update', $donation->id) }}">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="card-body">
                                <input type="hidden" name="blood_type_id" value="{{ $donation->blood_type_id }}">
                                <input type="hidden" name="city_id" value="{{ $donation->city_id }}">
                                <input type="hidden" name="patient_name" value="{{ $donation->patient_name }}">
                                <input type="hidden" name="patient_age" value="{{ $donation->patient_age }}">


                                <div class="form-group">
                                    <label>{{ __('messages.patient_phone') }} </label>
                                    <input type="text" class="form-control" name="patient_phone"
                                        placeholder="Enter patient_phone"
                                        value="{{ old('patient_phone', $donation->patient_phone) }}">
                                </div>
                                @error('patient_phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label>{{ __('messages.hospitalname') }} </label>
                                    <input type="text" class="form-control" name="hospital_name"
                                        placeholder="Enter Hospital Name"
                                        value="{{ old('hospital_name', $donation->hospital_name) }}">
                                </div>
                                @error('hospital_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <div class="form-group">
                                    <label>{{ __('messages.notes') }} </label>
                                    <textarea class="form-control" name="notes" rows="5">{{ old('notes', $donation->notes) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('messages.number_of_bags') }} </label>
                                    <input type="text" class="form-control" name="number_of_bags"
                                        placeholder="Enter The Number Of Bags"
                                        value="{{ old('number_of_bags', $donation->number_of_bags) }}">
                                </div>
                                @error('number_of_bags')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
