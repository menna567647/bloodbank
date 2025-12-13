@extends('website.layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="text-center mb-3">
            <a href="{{ route('website.donation.create') }}" class="btn btn-primary">
                {{ __('messages.createdonationrequest') }}
            </a>
        </div>
        @session('message')
            <h2 class="text-center alert alert-success">{{ session('message') }}</h2>
        @endsession
        <div class="d-flex justify-content-center">
            <table class="table table-bordered table-striped w-75">
                <thead class="text-center">
                    <tr>
                        <th>{{ __('messages.action') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th>{{ __('messages.hospital') }}</th>
                        <th>{{ __('messages.city') }}</th>
                        <th>{{ __('messages.bloodtype') }}</th>
                        <th>{{ __('messages.patientname') }}</th>
                    </tr>
                </thead>

                <tbody class="text-center">
                    @foreach ($donations as $item)
                        <tr>
                            <td>
                                <div class="d-flex">
                                    <form method="post" action="{{ route('website.donation.delete', $item->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this request?')"
                                            class="btn btn-danger btn-sm">{{ __('messages.delete') }}</button>
                                    </form>
                                    <a href="{{ route('website.donation.edit', $item->id) }}"
                                        class="btn btn-success btn-sm ml-2">{{ __('messages.edit') }}</a>
                                </div>
                            </td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->hospital_name }}</td>
                            <td>{{ $item->city->name }}</td>
                            <td>{{ $item->bloodType->name }}</td>
                            <td>{{ $item->patient_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
