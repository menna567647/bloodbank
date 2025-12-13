@extends('admin.layouts.main')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <ol class="breadcrumb mb-0 p-2 bg-light" style="float: left;">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}">{{ __('messages.dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ __('messages.clients') }}</li>
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
                        <h3 class="card-title"> {{ __('messages.clients') }}
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @include('admin.layouts.partials.session')

                        <form method="GET" action="{{ route('admin.clients.index') }}"
                            class="mb-4 p-4 bg-light rounded shadow-sm">
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <input type="text" name="name" class="form-control"
                                        placeholder="{{ __('messages.SearchByName') }}" value="{{ request('name') }}">
                                </div>

                                <div class="col-md-3 mb-2">
                                    <select name="city_id" class="form-control">
                                        <option value="">{{ __('messages.selectcity') }}</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                {{ request('city_id') == $city->id ? 'selected' : '' }}>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3 mb-2">
                                    <select name="blood_type_id" class="form-control">
                                        <option value="">{{ __('messages.selectbloodtype') }}</option>
                                        @foreach ($bloodTypes as $blood)
                                            <option value="{{ $blood->id }}"
                                                {{ request('blood_type_id') == $blood->id ? 'selected' : '' }}>
                                                {{ $blood->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2 mb-2">
                                    <button type="submit" class="btn btn-primary w-100">بحث</button>
                                </div>
                            </div>
                        </form>

                        @if ($clients->total() > 0)
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th> {{ __('messages.name') }} </th>
                                        <th> {{ __('messages.dateofbirth') }} </th>
                                        <th> {{ __('messages.phone') }} </th>
                                        <th> {{ __('messages.email') }} </th>
                                        <th> {{ __('messages.city') }} </th>
                                        <th> {{ __('messages.last_donation_date') }} </th>
                                        <th> {{ __('messages.bloodtype') }} </th>
                                        <th> {{ __('messages.status') }} </th>
                                        <th style="width: 40px"> {{ __('messages.action') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->dob }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->city->name }}</td>
                                            <td>{{ $item->last_donation_date }}</td>
                                            <td>{{ $item->bloodType->name }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('admin.clients.edit', $item->id) }}"
                                                        class="btn btn-outline-primary btn-sm mr-2">
                                                        {{ __('messages.edit') }}</a>

                                                    <button type="button"
                                                        data-url="{{ route('admin.clients.destroy', $item->id) }}"
                                                        class="btn btn-outline-danger btn-sm delete-btn">
                                                        {{ __('messages.delete') }}
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            @if (request()->filled('name'))
                                <p><span>{{ __('messages.noclientwiththename') }}</span> "{{ request('name') }}"</p>
                            @elseif (request()->filled('city_id'))
                                @php
                                    $selectedCity = $cities->firstWhere('id', request('city_id'));
                                @endphp
                                <p>
                                    <span>{{ __('messages.noclientsincity') }}</span>
                                    "{{ $selectedCity ? $selectedCity->name : '' }}"
                                </p>
                            @elseif (request()->filled('blood_type_id'))
                                @php
                                    $selectedBlood = $bloodTypes->firstWhere('id', request('blood_type_id'));
                                @endphp
                                <p>
                                    <span>{{ __('messages.noclientswithbloodtype') }}</span>
                                    "{{ $selectedBlood ? $selectedBlood->name : '' }}"
                                </p>
                                </p>
                            @else
                                <p>{{ __('messages.NoClients') }}</p>
                            @endif
                        @endif
                        @if (request()->hasAny(['name', 'city_id', 'blood_type_id']))
                            <a href="{{ route('admin.clients.index') }}" class="btn btn-primary mt-2">
                                <i class="fa-solid fa-arrow-left"></i> {{ __('messages.back') }}
                            </a>
                        @endif
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $clients->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('admin.layouts.partials.scripts')
