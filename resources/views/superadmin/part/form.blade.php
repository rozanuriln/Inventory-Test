@extends('superadmin.dashboard.layout.main')
@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{$title}}</h1>
</div>

<div class="row">
  <div class="col-lg-6">

    <div class="card">
      <div class="card-body">
        <form method="post" action="{{ $data->route }}" enctype="multipart/form-data">
          @if (session('failed'))
              <div class="alert alert-danger mg-b-0" role="alert">
                  {{ session('failed') }}
              </div>
          @endif
          @csrf
          @if($data->type != 'create')
              @method('PUT')
          @endif
              <div class="mb-3">
              <label for="name" class="form-label">Gudang</label>
              @php
                  $gudangActive = $data->gudang_id ?? old('gudang_id');
              @endphp
              <select name="gudang_id" id="" class="form-control" {{ $data->type == 'detail' ? 'disabled' : ''}} required>
                  <option value="">Pilih Lokasi Gudang</option>
                  @foreach ($gudang as $g)
                      <option {{$gudangActive == $g->id ? 'selected': ''}} value="{{$g->id}}">{{$g->nama}}</option>
                  @endforeach
              </select>
              @error('gudang_id')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">No Part</label>
              <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->no_part ?? old('no_part')}}' class="form-control @error('no_part') is-invalid @enderror" id="no_part" name="no_part" required autofocus>
              @error('no_part')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">Nama Barang</label>
              <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->nama_barang ?? old('nama_barang')}}' class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" required autofocus>
              @error('nama_barang')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">stok</label>
              <input type="number"  min='1' {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->stok ?? old('stok')}}' class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" required autofocus>
              @error('stok')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

      <div class="mb-3">
        <label for="name" class="form-label">Jenis Barang</label>
        <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->jenis_barang ?? old('jenis_barang')}}' class="form-control @error('jenis_barang') is-invalid @enderror" id="jenis_barang" name="jenis_barang" required autofocus>
        @error('jenis_barang')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
            <div class="mb-3">
              <label for="deskripsi" class="form-label">Deskripsi</label>
              @error('deskripsi')
              <p class="text-danger"> {{ $message }}</p>
              @enderror
              <textarea class="form-control"  {{ $data->type == 'detail' ? 'disabled' : ''}} name="deskripsi" id="deskripsi" cols="30" rows="10">{{$data->deskripsi ?? old('deskripsi')}}</textarea>

            </div>
            <div class="mb-3">
              <label for="name" class="form-label">barcode</label>
              <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->barcode ?? old('barcode')}}' class="form-control @error('barcode') is-invalid @enderror" id="barcode" name="barcode" required autofocus>
              @error('barcode')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">foto</label>
              <input type="file" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->foto ?? old('foto')}}' class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" autofocus>
              @error('foto')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            @if($data->type != 'detail')
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn btn-danger">Reset</button>
            @else
              <a href="{{route('part.edit', $data->id)}}"><button type="button" class="btn btn-primary">Edit</button></a>
            @endif
            <a href="{{route('part.index')}}"><button type="button" class="btn btn-dark">Kembali</button></a>
        </form>
      </div>
    </div>

  </div>

  <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h4>Import Data</h4>

          <form method="post" action="{{ route('importData') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

              <label>Pilih file excel <a href="{{asset('template/Template Import.xlsx')}}" target="_blank">Download Template</a></label>
              <div class="form-group">
                  <input type="file" name="file" required="required">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Import</button>
              </div>
          </form>
        </div>
      </div>
  </div>
</div>
<!-- {{-- <script>
  const tittle = document.querySelector('#tittle');
  const slug = document.querySelector('#slug');

  tittle.addEventListener('change', function (){
    fetch('/part1/checkSlug?tittle=' + tittle.value)
    .then(response => response.json())
    .then(data => slug.value = data.slug)
  });
</script> --}}
{{-- <script>
  document.addEventListener('trix-file-accept', function(e){
    e.preventDefault();
  })
</script> --}}
@endsection
@section ('scripts')

<script>
  ClassicEditor
      .create( document.querySelector( '#body' ) )
      .catch( error => {
          console.error( error );
      } );
</script> -->

@endsection
