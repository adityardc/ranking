{{-- @extends('layouts.admin')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom bg-inverse-danger">
      <li class="breadcrumb-item active" aria-current="page"><span>GANTI PASSWORD</span></li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Ubah Password</h4>
                <p class="card-description">
                    Untuk menjaga kerahasiaan Akun Anda, silahkan lakukan pergantian Password Anda.
                    <br>
                    
                    Tanda <code>*</code> wajib diisi !
                </p>
                <form class="forms-sample" method="POST" action="{{ $url }}" id="frmBagian">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputUsername2">New Password <code>*</code></label>
                                <input type="password" class="form-control" id="pwd1" name="pwd1" autofocus required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputUsername2">Re-Type New Password <code>*</code></label>
                                <input type="password" class="form-control" name="pwd2" id="pwd2">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Ubah</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        @include('layouts.message')
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('template/vendors/jquery-validation/jquery.validate.min.js') }}"></script>
<script>
    $(function(){
        $("#frmBagian").validate({
            rules: {
                pwd1: {
                    required: true,
                    maxlength: 150
                },
                pwd2: {
                    required: true,
                    maxlength: 150
                }
            },
            messages: {
                pwd1: {
                    required: "Kolom harus diisi !",
                    maxlength: "Maksimal karakter 150 !"
                },
                pwd2: {
                    required: "Kolom harus diisi !",
                    maxlength: "Maksimal karakter 150 !"
                }
            },
            errorPlacement: function(label, element) {
                label.addClass('mt-2 text-danger');
                label.insertAfter(element);
            },
            highlight: function(element, errorClass) {
                $(element).parent().addClass('has-danger');
                $(element).addClass('form-control-danger');
            }
        });
    });
</script>
@endsection --}}

@extends('layouts.admin')

@section('content')
<h4 class="page-title">Halaman Ubah Pasword</h4>
<div class="row">
    <div class="col-lg-6">
        <div class="card-box ribbon-box">
            <div class="ribbon ribbon-blue float-left"><i class="mdi mdi-access-point mr-1"></i> Form Ubah Password</div>
            <div class="ribbon-content">
                <form role="form" id="frmBagian" method="POST" action="{{ $url }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputUsername2">New Password <code>*</code></label>
                                <input type="password" class="form-control" id="pwd1" name="pwd1" autofocus required>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputUsername2">Re-Type New Password <code>*</code></label>
                                <input type="password" class="form-control" name="pwd2" id="pwd2">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> UBAH</button>
                    </div>
                    <p>
                        <code>*</code> Untuk menjaga kerahasiaan akun anda, silahkan ganti password anda !
                    </p>
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