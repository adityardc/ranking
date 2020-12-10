@extends('layouts.admin')

@section('content')
<h4 class="page-title">Halaman Edit Profile</h4>
<div class="row">
    <div class="col-lg-6">
        <div class="card-box ribbon-box">
            <div class="ribbon ribbon-blue float-left"><i class="mdi mdi-access-point mr-1"></i> Form Edit Profile</div>
            <div class="ribbon-content">
                <form role="form" id="frmBagian" method="POST" action="{{ route('beranda.update_profile', $data->uuid) }}">
                    @csrf
                    {{ method_field('PUT') }}

                    <div class="form-group has-error">
                        <label for="exampleInputUsername2">Nama Pengguna Aplikasi <code>*</code></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}" autofocus required>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group has-error">
                                <label for="exampleInputUsername2">Alamat Email <code>*</code></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputUsername2">ID SAP / Username <code>*</code></label>
                                <input type="text" class="form-control" id="username" name="username" value="{{ $data->username }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group has-error">
                                <label for="exampleInputUsername2">Password Baru</label>
                                <input type="password" class="form-control" id="pwd1" name="pwd1">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputUsername2">Ketik Ulang Password Baru</label>
                                <input type="password" class="form-control" id="pwd2" name="pwd2">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> UBAH</button>
                        <button type="button" class="btn btn-warning" onclick="location.href='{{ route('beranda') }}'"><i class="mdi mdi-step-backward"></i> BATAL/KEMBALI</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        @include('layouts.message')
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('js/bootstrapValidator.js') }}"></script>
<script>
    // Function mencegah submit form dari tombol enter
    function stopRKey(evt) {
        var evt = (evt) ? evt : ((event) ? event : null);
        var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
        if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
    }
    document.onkeypress = stopRKey;
</script>
@endsection