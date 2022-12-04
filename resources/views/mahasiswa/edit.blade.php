 @extends('layout.template')
 @section('konten')
     <form action='{{ url('mahasiswa/' . $data->nim) }}' method='post' enctype="multipart/form-data">
         @csrf
         @method('PUT')
         <div class="my-3 p-3 bg-body rounded shadow-sm">
             <a href='{{ url('mahasiswa') }}' class=" btn btn-secondary"> kembali </a>

             <div class="mb-3 row">
                 <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                 <div class="col-sm-10">
                     {{ $data->nim }}
                 </div>
             </div>
             <div class="mb-3 row">
                 <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                 <div class="col-sm-10">
                     <input type="text" class="form-control" name='nama' value="{{ $data->nama }}" id="nama">
                 </div>
             </div>
             <div class="mb-3 row">
                 <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                 <div class="col-sm-10">
                     <input type="text" class="form-control" name='jenis_kelamin' value="{{ $data->jenis_kelamin }}"
                         id="nama">
                 </div>
             </div>
             <div class="mb-3 row">
                 <label for="jurusan" class="col-sm-2 col-form-label">Prodi</label>
                 <div class="col-sm-10">
                     <input type="text" class="form-control" name='jurusan' value="{{ $data->jurusan }}" id="jurusan">
                 </div>
             </div>
             <div class="mb-3 row">
                 <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                 <div class="col-sm-10">
                     <input type="text" class="form-control" name='alamat' value="{{ $data->alamat }}" id="alamat">
                 </div>
             </div>
             <div class="mb-3 row">
                 <label for="email" class="col-sm-2 col-form-label">Email</label>
                 <div class="col-sm-10">
                     <input type="email" class="form-control" name='email' value="{{ $data->email }}" id="email">
                 </div>
             </div>
             @if ($data->foto)
                 <div class="mb-3">
                     <img style="max-height: 50px; max-width:50px col-sm-2" src="{{ url('foto') . '/' . $data->foto }}">
                 </div>
             @endif
             <div class="mb-3 row">
                 <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                 <div class="col-sm-10">
                     <input type="file" class="form-control" name='foto' id="foto">
                 </div>
             </div>
             <div class="mb-3 row">
                 <label for="jurusan" class="col-sm-2 col-form-label"></label>
                 <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                 </div>
             </div>
         </div>
     </form>
 @endsection
