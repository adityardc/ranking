@if (Session::has('sukses'))
<div class="alert alert-success" role="alert">
    {{ Session::get('sukses') }}
</div>
@elseif(Session::has('gagal'))
<div class="alert alert-danger" role="alert">
    {{ Session::get('gagal') }}
</div>
@elseif(Session::has('gagal_upload'))
<div class="alert alert-danger" role="alert">
    <strong>Errors:</strong>
    <ul>
       @foreach ($th as $failure)
          @foreach ($failure->errors() as $error)
              <li>{{ $error }}</li>
          @endforeach
       @endforeach
    </ul>
 </div>
@elseif($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li><strong>{{ $error }}</strong></li>
        @endforeach
    </ul>
</div>
@endif
