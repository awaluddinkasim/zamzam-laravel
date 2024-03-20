@extends('layout')

@section('title', $user->nama)

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 d-flex align-items-center justify-content-center">
                    <div>
                        <div class="text-center">
                            <img src="{{ asset('assets/images/avatar.png') }}" alt="" class="w-25">
                            <h4 class="my-4">{{ $user->nama }}</h4>
                        </div>
                        <div style="width: 250px; margin: auto">
                            <table>
                                <tr>
                                    <td>Email</td>
                                    <td class="px-3">:</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td>No. HP</td>
                                    <td class="px-3">:</td>
                                    <td>{{ $user->no_hp }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td class="px-3">:</td>
                                    <td>{{ $user->alamat }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{ asset('assets/images/svg/user.svg') }}" alt="" class="w-75">
                </div>
            </div>
        </div>
    </div>
@endsection
