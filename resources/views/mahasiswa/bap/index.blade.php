@extends('layouts.mahasiswa.app')

@section('title', 'Data Berita Acara Perkuliahan (BAP)')

@section('contents')
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5>Data Berita Acara Perkuliahan (BAP)</h5>
        </div>
        <div class="card-body">
          <table class="table-bordered table">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Dosen Pengajar</th>
                <th>Mata Kuliah</th>
                <th>Materi</th>
                <th>Keterangan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($baps as $index => $bap)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $bap->tanggal }}</td>
                  <td>
                    <!-- Menampilkan nama dosen pengajar dengan pengecekan -->
                    {{ optional($bap->creator)->name ?? 'Dosen Tidak Ditemukan' }}
                  </td>
                  <td>{{ $bap->jadwal->mataKuliah->nama_mk }}</td>
                  <td>{{ $bap->materi }}</td>
                  <td>{{ $bap->keterangan }}</td>
                  <td>
                    <a href="{{ route('mahasiswa.bap.show', $bap->id) }}" class="btn btn-info btn-sm">Detail</a>
                    @if ($bap->feedbacks->count() < 2)
                      <a href="{{ route('mahasiswa.feedback.create', $bap->id) }}" class="btn btn-primary btn-sm">Berikan
                        Feedback</a>
                    @endif
                  </td>
                </tr>
              @endforeach
              @if ($baps->isEmpty())
                <tr>
                  <td colspan="7" class="text-center">Belum ada BAP yang tersedia untuk kelas Anda.</td>
                  <!-- Sesuaikan jumlah kolom -->
                </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
