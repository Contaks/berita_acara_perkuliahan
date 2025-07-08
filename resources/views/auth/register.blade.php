<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="BAP Online Register Page">
  <title>BAP Online - Register</title>

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
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-8 col-md-10">
        <div class="card o-hidden my-5 border-0 shadow-lg">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <img src="{{ asset('admin_assets/img/binabangsa.png') }}" alt="Logo"
                      class="img-fluid rounded-circle mb-4" style="width: 100px; height: 100px;">
                    <h1 class="h4 mb-4 text-gray-900">Create an Account!</h1>
                  </div>

                  <!-- Registration Form -->
                  <form action="{{ route('register.save') }}" method="POST" class="user">
                    @csrf

                    @if ($errors->any())
                      <div class="alert alert-danger">
                        <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif

                    <div class="form-group">
                      <input name="name" type="text" class="form-control form-control-user"
                        placeholder="Full Name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                      <input name="email" type="email" class="form-control form-control-user"
                        placeholder="Email Address" value="{{ old('email') }}">
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6 mb-sm-0 mb-3">
                        <input name="password" type="password" class="form-control form-control-user"
                          placeholder="Password">
                      </div>
                      <div class="col-sm-6">
                        <input name="password_confirmation" type="password" class="form-control form-control-user"
                          placeholder="Repeat Password">
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block">Register Account</button>
                  </form>

                  <hr>
                  <div class="text-center">
                    <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                  </div>
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
