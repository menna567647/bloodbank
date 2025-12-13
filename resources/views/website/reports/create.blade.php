@extends('website.layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">{{ __('messages.report') }}</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('website.report.store') }}">
                        @csrf
                        <input type="hidden" name="donation_id" value="{{ $donation->id }}">

                        <div class="mb-3">
                            <label for="reason" class="form-label">reason for report</label>
                            <select name="reason" id="reason" class="form-select">
                                <option value="spam">{{ __('messages.spam') }}</option>
                                <option value="abuse">abuse</option>
                                <option value="other">other</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">{{ __('messages.message') }}</label>
                            <input type="text" name="message" id="message" class="form-control" placeholder="enter your message">
                        </div>

                        <button type="submit" class="btn btn-success w-100">{{ __('messages.report') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
