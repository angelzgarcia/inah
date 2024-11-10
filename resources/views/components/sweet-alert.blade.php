

@if (!empty($sweet))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                icon: "{{ $sweet['icon'] }}",
                title: "{{ $sweet['title'] }}",
                text: "{{ $sweet['text'] }}",
                showConfirmButton: {{ $sweet['showConfirmButton'] ?? 'true' }},
                timer: {{ $sweet['timer'] ?? 'null' }}
            });
        });
    </script>
@endif

