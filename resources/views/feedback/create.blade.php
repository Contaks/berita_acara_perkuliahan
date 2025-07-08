<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Form Feedback</title>
  <!-- Custom fonts for this template-->
  <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h5>Form Feedback</h5>
            <p class="text-muted">Silakan isi form feedback berikut. Maksimal feedback diterima adalah dari 2 mahasiswa.
            </p>
          </div>
          <div class="card-body">
            {{-- Menampilkan pesan sukses atau error --}}
            @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @elseif (session('error'))
              <div class="alert alert-danger">
                {{ session('error') }}
              </div>
            @endif

            {{-- Menampilkan error validasi --}}
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            {{-- Form Feedback --}}
            <form action="{{ route('feedback.store') }}" method="POST">
              @csrf
              <input type="hidden" name="bap_id" value="{{ $bap->id }}" />

              <div class="form-group">
                <label for="nama_mahasiswa">Nama Mahasiswa</label>
                <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" class="form-control"
                  placeholder="Masukkan nama lengkap Anda" required>
              </div>

              <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" name="nim" id="nim" class="form-control" placeholder="Masukkan NIM Anda"
                  required>
              </div>

              <div class="form-group">
                <label for="kelas">Kelas</label>
                <input type="kelas" name="kelas" id="kelas" class="form-control"
                  placeholder="Masukkan kelas Anda" required>
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control"
                  placeholder="Masukkan email Anda" required>
              </div>

              <div class="form-group">
                <label for="feedback">Feedback</label>
                <textarea name="feedback" id="feedback" rows="4" class="form-control"
                  placeholder="Tulis feedback Anda di sini..." required></textarea>
              </div>

              <button type="submit" class="btn btn-primary">Kirim Feedback</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>
  <!-- Page level plugins -->
  <script src="{{ asset('admin_assets/vendor/chart.js/Chart.min.js') }}"></script>
</body>

</html>
