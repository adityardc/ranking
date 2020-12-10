@extends('layouts.admin')

@section('breadcrumb')
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Manajemen Master Data</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Perusahaan</a></li>
            <li class="breadcrumb-item active">Ubah Data</li>
        </ol>
    </div>
@endsection

@section('content')
<h4 class="page-title">Halaman Perusahaan</h4>
<div class="row">
    <div class="col-lg-6">
        <div class="card-box ribbon-box">
            <div class="ribbon ribbon-blue float-left"><i class="mdi mdi-access-point mr-1"></i> Form Ubah Perusahaan</div>
            <div class="ribbon-content">
                <form role="form" id="frmBagian" method="POST" action="{{ route('ptpn.update', $ptpn->id) }}">
                    @csrf
                    {{ method_field('PUT') }}

                    <div class="row">
                        <div class="col-sm-9 col-md-9">
                            <div class="form-group has-error">
                                <label for="exampleInputUsername2">Nama Perusahaan <code>*</code></label>
                                <input type="text" class="form-control" id="company" name="company" value="{{ $ptpn->company }}" autofocus required>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="exampleInputUsername2">Kode Perusahaan <code>*</code></label>
                                <input type="text" class="form-control" id="company_code" name="company_code" value="{{ $ptpn->company_code }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group has-error">
                                <label for="exampleInputUsername2">Deskripsi Perusahaan <code>*</code></label>
                                <textarea name="description" id="description" cols="30" rows="5" class="form-control" required>{{ $ptpn->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputUsername2">Alamat Perusahaan <code>*</code></label>
                                <textarea name="address" id="address" cols="30" rows="5" class="form-control" required>{{ $ptpn->address }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> UBAH</button>
                        <button type="button" class="btn btn-warning" onclick="location.href='{{ route('ptpn.index') }}'"><i class="mdi mdi-step-backward"></i> BATAL/KEMBALI</button>
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