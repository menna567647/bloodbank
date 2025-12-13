    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.body.addEventListener('click', function(e) {
                const button = e.target.closest('.love-btn');
                if (!button) return;

                const postId = button.dataset.id;
                const messageDiv = button.nextElementSibling;

                fetch(`/favorites-save/${postId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        messageDiv.textContent = data.message;
                        messageDiv.style.display = 'block';
                        messageDiv.style.color = data.status ? 'green' : 'red';

                        const icon = button.querySelector('i');
                        icon.classList.toggle('fas', data.status);
                        icon.classList.toggle('far', !data.status);

                        Swal.fire({
                            title: "",
                            text: data.message,
                            icon: data.status ? "success" : "error",
                            confirmButtonText: "OK",
                            customClass: {
                                confirmButton: "btn btn-success"
                            },
                            buttonsStyling: false
                        });
                    });
            });
        });
    </script>