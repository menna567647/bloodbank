@extends('admin.layouts.main')
@section('content-header')
    <div class="container mt-3">
        <div class="row">
            <!-- left column -->
            <div class="col-md-8 m-auto">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('messages.editdonationrequest') }}</h3>
                    </div>
                    <form method="post" action="{{ route('admin.donations.update', $donation->id) }}">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="card-body">
                                <div class="form-group">
                                        <select name="is_spam" class="form-select">
                                            <option value="1">
                                                {{ __('messages.spam') }}
                                            </option>
                                            <option value="0">
                                                {{ __('messages.notspam') }}
                                            </option>
                                        </select>
                                        @error('is_spam')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
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
