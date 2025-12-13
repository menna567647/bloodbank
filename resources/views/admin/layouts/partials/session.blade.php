          @if (session('message'))
              <script>
                  document.addEventListener('DOMContentLoaded', function() {
                      Swal.fire({
                          title: "",
                          text: "{{ session('message') }}",
                          icon: "success",
                          confirmButtonText: "OK",
                          customClass: {
                              confirmButton: "btn btn-success"
                          },
                          buttonsStyling: false
                      });
                  });
              </script>
          @endif
