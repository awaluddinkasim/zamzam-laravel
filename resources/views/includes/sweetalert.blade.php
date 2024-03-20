@if (Session::has('success'))
    <script>
        Swal.fire({
            title: "Berhasil",
            text: "{{ Session::get('success') }}",
            icon: "success"
        });
    </script>
@endif
@if (Session::has('error'))
    <script>
        Swal.fire({
            title: "Gagal",
            text: "{{ Session::get('error') }}",
            icon: "error"
        });
    </script>
@endif
