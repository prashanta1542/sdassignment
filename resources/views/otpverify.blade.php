<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <header>
        <div class="container">
            <!-- A grey horizontal navbar that becomes vertical on small screens -->
            <nav class="navbar navbar-expand-sm bg-light">

                <!-- Links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('login')}}">Login</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="container">
        @if(session()->has('rolenull'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Failed!</strong> {{ session()->get('rolenull') }}
        </div>
        @endif
      
        <form method="post" action="{{url('otpvrify')}}">
            @csrf
            
            <div class="form-group">
                <label>OTP  :</label>
                <input type="text" name="otp" placeholder="Write your otp" required class="form-control">
            </div>
           
            <button type="submit" class="btn btn-primary">Verify</button>
            <div>
                <p>Not Register Yet ?<a href="{{url('register')}}"> Register here</a></p>
                <p>Have already account?<a href="{{url('login')}}"> Login here</a></p>
            </div>
        </form>
    </div>

</body>

</html>