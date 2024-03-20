@extends('layout')

@section('title', 'Profile')

@section('content')
    <div class="card overflow-hidden">
        <div class="card-body">
            <div class="position-relative">
                <div class="rounded bg-primary" style="height: 200px"></div>
                <div class="position-absolute top-100 start-50 translate-middle">
                    <img src="{{ asset('assets/images/avatar.png') }}" width="110" height="110"
                        class="rounded-circle raised p-1 bg-white" alt="">
                </div>
            </div>
            <div class="mt-5 d-flex align-items-start justify-content-between">
                <div class="">
                    <h3 class="my-2">{{ auth()->user()->nama }}</h3>
                    <p class="mb-4">{{ auth()->user()->email }}</p>
                </div>
                <div class="">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-pencil me-2"></i>Edit
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.update') }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off"
                                value="{{ auth()->user()->nama }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" autocomplete="off"
                                value="{{ auth()->user()->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Ganti Password</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" class="form-control" id="password" name="password">
                                <a href="javascript:;" class="input-group-text bg-transparent"><i
                                        class="bi bi-eye-slash-fill"></i></a>
                            </div>
                            <small class="text-muted fst-italic">* Kosongkan jika tidak ingin mengganti password</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bi-eye-slash-fill");
                    $('#show_hide_password i').removeClass("bi-eye-fill");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bi-eye-slash-fill");
                    $('#show_hide_password i').addClass("bi-eye-fill");
                }
            });
        });
    </script>
@endpush
