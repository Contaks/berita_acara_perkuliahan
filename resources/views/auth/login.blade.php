<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="BAP Online Login Page">
  <meta name="author" content="">
  <title>BAP Online - Login</title>

  <!-- Custom Fonts -->
  <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom Styles -->
  <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link rel="icon" href="{{ asset('admin_assets/img/binabangsa.png') }}" type="image/x-icon">
</head>

<body class="bg-gradient-primary">
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-8 col-md-10">
        <div class="card o-hidden my-5 border-0 shadow-lg">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <!-- Ganti ikon dengan gambar logo kecil -->
                    <img src="{{ asset('admin_assets/img/binabangsa.png') }}" alt="Logo"
                      class="img-fluid rounded-circle mb-4" style="width: 100px; height: 100px;">
                    <h1 class="h4 mb-4 text-gray-900">Login BAP Online!</h1>
                    <p class="text-gray-600">Please sign in to continue</p>
                  </div>

                  <!-- Login Form -->
                  <form action="{{ route('login') }}" method="POST" class="user">
                    @csrf

                    <!-- Error Messages -->
                    @if ($errors->any())
                      <div class="alert alert-danger">
                        <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif

                    <!-- Email Input -->
                    <div class="form-group">
                      <input name="email" type="email" class="form-control form-control-user" id="exampleInputEmail"
                        aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>

                    <!-- Password Input -->
                    <div class="form-group">
                      <input name="password" type="password" class="form-control form-control-user"
                        id="exampleInputPassword" placeholder="Password">
                    </div>

                    <!-- Remember Me Checkbox -->
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input name="remember" type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary btn-block btn-user">Login</button>
                  </form>

                  <hr>

                  <!-- Optional: Forgot Password Link -->
                  {{-- <div class="text-center">
                    <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                  </div> --}}

                  <!-- Optional: Registration Link -->
                  {{-- <div class="text-center">
                    <a class="small" href="{{ route('register') }}">Create an Account!</a>
                  </div> --}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap Core JavaScript -->
  <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core Plugin JavaScript -->
  <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom Scripts -->
  <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>
</body>

</html>
