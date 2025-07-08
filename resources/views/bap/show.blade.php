@extends('layouts.app')

@section('title', 'Detail BAP')

@section('contents')
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Detail Berita Acara Perkuliahan</h3>
        </div>
        <div class="card-body">
          <table class="table-bordered table">
            <tr>
              <th>ID BAP</th>
              <td>{{ $bap->id }}</td>
            </tr>
            <tr>
              <th>Tanggal</th>
              <td>{{ \Carbon\Carbon::parse($bap->tanggal)->format('d-m-Y') }}</td>
            </tr>
            <tr>
              <th>Jadwal</th>
              <td>
                Hari: {{ $bap->jadwal->hari ?? 'Tidak tersedia' }}<br>
                Waktu: {{ $bap->jadwal->waktu_mulai ?? '' }} - {{ $bap->jadwal->waktu_selesai ?? '' }}
              </td>
            </tr>
            <tr>
              <th>Mata Kuliah</th>
              <td>{{ $bap->jadwal->mataKuliah->nama ?? 'Tidak tersedia' }}</td>
            </tr>
            <tr>
              <th>Kelas</th>
              <td>{{ $bap->jadwal->kelas ?? 'Tidak tersedia' }}</td>
            </tr>
            <tr>
              <th>Materi</th>
              <td>{{ $bap->materi }}</td>
            </tr>
            <tr>
              <th>Keterangan</th>
              <td>{{ $bap->keterangan ?? '-' }}</td>
            </tr>
          </table>

          <h4 class="mt-4">Feedback Mahasiswa</h4>
          @if ($bap->feedbacks->isNotEmpty())
            <table class="table-striped table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Mahasiswa</th>
                  <th>Feedback</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($bap->feedbacks as $index => $feedback)
                  <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $feedback->nama_mahasiswa }}</td>
                    <td>{{ $feedback->feedback }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @else
            <p>Tidak ada feedback yang diberikan oleh mahasiswa.</p>
          @endif
        </div>

        <div class="card-footer">
          <a href="{{ route('bap.index') }}" class="btn btn-secondary">Kembali</a>

          @if ($bap->feedbacks->count() < 2)
            <!-- Tombol untuk membuka modal -->
            <button class="btn btn-primary" data-toggle="modal" data-target="#shareModal">
              Share Form Feedback
            </button>
          @else
            <button class="btn btn-secondary" disabled>Feedback Penuh</button>
          @endif
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Pop-up -->
  <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="shareModalLabel">Salin Link Form Feedback</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Bagikan link ini kepada mahasiswa untuk memberikan feedback:</p>
          <div class="input-group">
            <input type="text" id="feedbackLink" class="form-control"
              value="{{ route('feedback.create', ['bap_id' => $bap->id]) }}" readonly>
            <div class="input-group-append">
              <button class="btn btn-success" onclick="copyLink()">Salin</button>
            </div>
          </div>
          <p id="copySuccess" class="text-success mt-2" style="display: none;">Link berhasil disalin!</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Script untuk Menyalin Link -->
  <script>
    function copyLink() {
      var copyText = document.getElementById("feedbackLink");
      copyText.select();
      copyText.setSelectionRange(0, 99999); // Untuk perangkat mobile
      document.execCommand("copy");

      // Tampilkan pesan sukses
      document.getElementById("copySuccess").style.display = "block";

      // Sembunyikan pesan sukses setelah 3 detik
      setTimeout(() => {
        document.getElementById("copySuccess").style.display = "none";
      }, 3000);
    }
  </script>
@endsection
