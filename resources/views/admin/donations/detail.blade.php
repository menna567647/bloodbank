@extends('admin.layouts.main')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <ol class="breadcrumb mb-0 p-2 bg-light" style="float: left;">
                    <li class="breadcrumb-donation">
                        <a href="{{ route('admin.home') }}">{{ __('messages.dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-donation active">{{ __('messages.DonationRequest') }}</li>
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
                        @include('admin.layouts.partials.session')
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('messages.name') }}</th>
                                    <th>{{ __('messages.age') }}</th>
                                    <th>{{ __('messages.phone') }}</th>
                                    <th>{{ __('messages.bloodtype') }}</th>
                                    <th>{{ __('messages.number_of_bags') }}</th>
                                    <th>{{ __('messages.city') }}</th>
                                    <th>{{ __('messages.hospitalname') }}</th>
                                    <th>{{ __('messages.notes') }}</th>
                                    <th>{{ __('messages.status') }}</th>
                                    <th>{{ __('messages.spams') }}</th>
                                    <th style="width: 40px">{{ __('messages.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $donation->patient_name }}</td>
                                    <td>{{ $donation->patient_age }}</td>
                                    <td>{{ $donation->patient_phone }}</td>
                                    <td>{{ $donation->bloodType->name }}</td>
                                    <td>{{ $donation->number_of_bags }}</td>
                                    <td>{{ $donation->city->name }}</td>
                                    <td>{{ $donation->hospital_name }}</td>
                                    <td>
                                        @if (!empty($donation->notes))
                                            @php
                                                $isLong = strlen($donation->notes) > 150;
                                            @endphp
                                            <p class="card-text text-muted mt-2 mb-4">
                                                <span id="content-short-{{ $donation->id }}">
                                                    {{ $isLong ? \Illuminate\Support\Str::limit($donation->notes, 150) : $donation->notes }}
                                                </span>
                                                @if ($isLong)
                                                    <span id="content-full-{{ $donation->id }}" class="d-none">
                                                        {{ $donation->notes }}
                                                    </span>
                                                    <a href="javascript:void(0);"
                                                        onclick="toggleContent({{ $donation->id }})"
                                                        id="content-btn-{{ $donation->id }}" class="text-primary ms-1"
                                                        style="text-decoration: underline; font-size: 0.9em;">
                                                        {{ __('messages.showmore') }}
                                                    </a>
                                                @endif
                                            </p>
                                        @else
                                            <p>{{ __('messages.nonotes') }}</p>
                                        @endif
                                    </td>
                                    <td>{{ $donation->status }}</td>
                                    <td>
                                        <p>
                                            {{ $donation->is_spam == 1 ? __('messages.spam') : __('messages.notspam') }}
                                        </p>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                            <a class="btn btn-outline-success mr-2"
                                                href="{{ route('admin.donations.edit', $donation->id) }}">{{ __('messages.mark_as_spam') }}</a>
                                                
                                            <button type="button"
                                                data-url="{{ route('admin.donations.destroy', $donation->id) }}"
                                                class="btn btn-outline-danger btn-sm delete-btn">
                                                {{ __('messages.delete') }}
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleText(id) {
            const shortText = document.getElementById(`text-${id}`);
            const fullText = document.getElementById(`full-text-${id}`);
            const btn = document.getElementById(`toggle-btn-${id}`);

            if (shortText.classList.contains('d-none')) {
                shortText.classList.remove('d-none');
                fullText.classList.add('d-none');
                btn.textContent = '{{ __('messages.showmore') }}';
            } else {
                shortText.classList.add('d-none');
                fullText.classList.remove('d-none');
                btn.textContent = '{{ __('messages.showless') }}';
            }
        }
    </script>


    <script>
        $('.delete-btn').click(function(e) {
            e.preventDefault();
            const url = $(this).data('url');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success ml-2",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: "{{ __('messages.sure_message') }}",
                text: "{!! __('messages.revert_warning') !!}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "{{ __('messages.confirm_delete') }}",
                cancelButtonText: "{{ __('messages.cancel_delete') }}",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(result) {
                            swalWithBootstrapButtons.fire({
                                title: "{{ __('messages.deleted') }}",
                                text: "{{ __('messages.donation_deleted_successfully') }}",
                                icon: "success"
                            }).then(() => {
                                window.location.href = '/admin/donations';
                            });
                        },
                        error: function(error) {
                            swalWithBootstrapButtons.fire({
                                title: "{{ __('messages.error') }}",
                                text: "{{ __('messages.donation_delete') }}",
                                icon: "error"
                            });
                        },
                    });
                }
            });
        });
    </script>
@endpush
