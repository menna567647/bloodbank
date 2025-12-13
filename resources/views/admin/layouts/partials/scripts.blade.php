@push('scripts')
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
                                text: "{{ __('messages.deleted_successfully') }}",
                                icon: "success"
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(error) {
                            swalWithBootstrapButtons.fire({
                                title: "{{ __('messages.error') }}",
                                text: "{{ __('messages.error_message') }}",
                                icon: "error"
                            });
                        },
                    });
                }
            });
        });
    </script>
@endpush