@extends('superadmin.dashboard.layout.main')
@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{$title}}</h1>
</div>

<div class="col-lg-12">

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
        <label for="deskripsi" class="form-label">Deskripsi</label>
        @error('deskripsi')
        <p class="text-danger"> {{ $message }}</p>
        @enderror
        <textarea class="form-control"  {{ $data->type == 'detail' ? 'disabled' : ''}} name="deskripsi" id="deskripsi" cols="30" rows="10">{{$data->deskripsi ?? old('deskripsi')}}</textarea>
      
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
        <!-- <label for="foto" class="form-label">Foto</label> -->
        <h6>Foto</h6>
        <img src="{{ asset('storage/foto/'.$data->foto) }}" alt="" clas="img-fluid mt-3" width="50%">
        @error('foto')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="foto" class="form-label">Barcode</label><br/>
        {!! DNS1D::getBarcodeSVG($data->barcode, 'C39')!!}
      </div>

      @if($data->type != 'detail')
      <button type="submit" class="btn btn-primary">Simpan</button>
      <button type="reset" class="btn btn-danger">Reset</button>
      @else
        <a href="{{route('part.edit', $data->id)}}"><button type="button" class="btn btn-primary">Edit</button></a>
      @endif
      <a href="{{route('part.index')}}"><button type="button" class="btn btn-dark">Kembali</button></a>
  </form>
  <h4 class="mt-4">History</h4>
  <hr>
  <a href="{{ route('history.create', ['id' => $id]) }}" class="btn btn-sm btn-primary float-end"><i class="fas fa-plus"></i> Tambah Data</a>
  <h3>Pemasukan</h3>
  <table class="table">
    <thead>
        <tr>
            <th>#</th><th>Tanggal</th><th>Type</th><th>Jumlah</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php
            $pemasukan = $pengeluaran = 0;
            $number= 1;
        @endphp
        @foreach ($history as $his)
        @php
            if($his->type == 1)
                $pemasukan+=$his->amount;
            if($his->type == 2)
                $pengeluaran+=$his->amount;
        @endphp
            @if ($his->type == 1)
            <tr>

              <td>{{$number++}}</td>
              <td>{{$his->tanggal}}</td>
              <td><span class="badge {{$his->type == 1 ? 'bg-primary' : 'bg-danger'}}">{{$his->type == 1 ? 'Pemasukan' : 'Pengeluaran'}}</span></td>
              <td>{{$his->amount}}</td>
              <td>
                  <a href="{{ route('history.edit', $his->id) }}" class="btn btn-sm btn-primary">Edit</a>
              </td>
            </tr>
            @endif
        @endforeach
    </tbody>
  </table>
  <h3>Pengeluaran</h3>
  <table class="table">
    <thead>
        <tr>
            <th>#</th><th>Tanggal</th><th>Type</th><th>Jumlah</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php
            $number= 1;
        @endphp
        @foreach ($history as $his)
            @if ($his->type != 1)
            <tr>

              <td>{{$number++}}</td>
              <td>{{$his->tanggal}}</td>
              <td><span class="badge {{$his->type == 1 ? 'bg-primary' : 'bg-danger'}}">{{$his->type == 1 ? 'Pemasukan' : 'Pengeluaran'}}</span></td>
              <td>{{$his->amount}}</td>
              <td>
                  <a href="{{ route('history.edit', $his->id) }}" class="btn btn-sm btn-primary">Edit</a>
              </td>
            </tr>
            @endif
        @endforeach
    </tbody>
  </table>
  <div class="row justify-content-md-center text-center">
    <div class="col-md-6">
        <h3 class="text-primary">Total Pemasukan</h3>
        <h3 class="text-primary">{{$pemasukan}}</h3>
    </div>
    <div class="col-md-6">
        <h3 class="text-danger">Total Pengeluaran</h3>
        <h3 class="text-danger">{{$pengeluaran}}</h3>
    </div>
    <div class="col-md-6">
        <h3 class="text-success">Jumlah Stok Saat Ini</h3>
        <h3 class="text-success">{{$pemasukan - $pengeluaran}}</h3>
    </div>
  </div>
</div>
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
