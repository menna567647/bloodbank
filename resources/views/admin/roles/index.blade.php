@extends('admin.layouts.main')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <ol class="breadcrumb mb-0 p-2 bg-light" style="float: left;">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}">{{ __('messages.dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ __('messages.role') }}</li>
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
                            <a class="btn btn-outline-primary btn-sm" href="{{ route('admin.roles.create') }}">
                                {{ __('messages.addrole') }}
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
                                    <th> {{ __('messages.name') }}</th>
                                    <th> {{ __('messages.permissions') }}</th>
                                    <th style="width: 40px"> {{ __('messages.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->permissions_count }}</td>
                                        <td>
                                            <div class="d-flex justify-content-start mt-3">
                                                <a href="{{ route('admin.roles.edit', $item->id) }}"
                                                    class="btn btn-outline-primary btn-sm mr-2">
                                                    {{ __('messages.edit') }}
                                                </a>
                                               <button type="button"
                                                    data-url="{{ route('admin.roles.destroy', $item->id) }}"
                                                    class="btn btn-outline-danger btn-sm delete-btn">
                                                    {{ __('messages.delete') }}
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
              @include('admin.layouts.partials.scripts')
