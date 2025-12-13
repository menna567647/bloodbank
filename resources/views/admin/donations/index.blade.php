@extends('admin.layouts.main')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <ol class="breadcrumb mb-0 p-2 bg-light" style="float: left;">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}">{{ __('messages.dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ __('messages.DonationRequests') }}</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('messages.DonationRequests') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>{{ __('messages.name') }}</th>
                                    <th>{{ __('messages.city') }}</th>
                                    <th>{{ __('messages.hospitalname') }}</th>
                                    <th>{{ __('messages.status') }}</th>
                                    <th>{{ __('messages.spams') }}</th>
                                    <th style="width: 40px">{{ __('messages.showdonationrequest') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donations as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->patient_name }}</td>
                                        <td>{{ $item->city->name }}</td>
                                        <td>{{ $item->hospital_name }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            <p>
                                                {{ $item->is_spam == 1 ? __('messages.spam') : __('messages.notspam') }}
                                            </p>
                                        </td>
                                        <td>
                                                <a class="btn btn-outline-primary mr-2"
                                                    href="{{ route('admin.donationDetails', $item->id) }}">{{ __('messages.show') }}
                                                    </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $donations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
