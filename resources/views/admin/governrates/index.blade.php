@extends('admin.layouts.main')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <ol class="breadcrumb mb-0 p-2 bg-light" style="float: left;">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}">{{ __('messages.dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ __('messages.GovernoratesList') }}</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('admin.governorates.create') }}">
                            {{ __('messages.ADDGOVERNORATE') }}
                        </a>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                                @include('admin.layouts.partials.session')

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>{{ __('messages.name') }}</th>
                                    <th>{{ __('messages.citiescount') }}</th>
                                    <th style="width: 40px">{{ __('messages.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($governrats as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            {{ $item->cities_count }}
                                        </td>
                                        <td>
                                         <button type="button"
                                                    data-url="{{ route('admin.governorates.destroy', $item->id) }}"
                                                    class="btn btn-outline-danger btn-sm delete-btn">
                                                    {{ __('messages.delete') }}
                                                </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $governrats->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
              @include('admin.layouts.partials.scripts')
