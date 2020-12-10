@extends('layouts.admin')

@section('content')
<h4 class="page-title">Beranda</h4>
<div class="row">
    <div class="col-lg-6 col-xl-6">
        <div class="card-box text-center">
            @if (Auth::user()->foto == NULL)
            <img src="{{ asset('assets/images/default-user.jpg') }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
            @else
            <img src="{{ url('storage/'.substr(Auth::user()->foto, 7)) }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
            @endif
            {{-- <img src="assets/images/users/user-1.jpg" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image"> --}}

            <h4 class="mb-0">{{ Auth::user()->name }}</h4>
            <p class="text-muted">{{ Auth::user()->username }}</p>

            <a href="{{ route('beranda.edit_profile', Auth::user()->uuid) }}" class="btn btn-success btn-xs waves-effect mb-2 waves-light">Edit Profile</a>

            <div class="text-left mt-3">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 20%"><p class="text-muted mb-2 font-13"><strong>Perusahaan</strong></p></td>
                        <td><p class="text-muted mb-2 font-13"><strong>:</strong></p></td>
                        <td><p class="text-muted mb-2 font-13"><strong>{{ Auth::user()->ptpn->company }}</strong></p></td>
                    </tr>
                    <tr>
                        <td><p class="text-muted mb-2 font-13"><strong>Unit Kerja</strong></p></td>
                        <td><p class="text-muted mb-2 font-13"><strong>:</strong></p></td>
                        <td><p class="text-muted mb-2 font-13"><strong>{{ Auth::user()->divisi->nama_divisi }}</strong></p></td>
                    </tr>
                    <tr>
                        <td><p class="text-muted mb-2 font-13"><strong>Hak Akses</strong></p></td>
                        <td><p class="text-muted mb-2 font-13"><strong>:</strong></p></td>
                        <td><p class="text-muted mb-2 font-13"><strong>{{ $x }}</strong></p></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-6">
        @include('layouts.message')
    </div>
</div>
@endsection

@section('script')

@endsection
