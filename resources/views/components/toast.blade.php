
@props(['name_event'])

{{-- SWEET ALERT TOAST --}}

<script>
    window.addEventListener(@json($name_event), event => {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast',
            },
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
            });
            Toast.fire({
            icon: event.detail.icon,
            title: event.detail.title
        });
    });
</script>
