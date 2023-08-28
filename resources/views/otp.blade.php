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
    <div class="card-group">
        <div class="card bg-primary">
            <div class="card-body text-center">
                <p class="alert alert-primary">Thank you {{$name}}</p>
                <p class="alert alert-primary">This is your OTP : <bold>{{$otp}}</bold>
                </p>
                <p class="alert alert-primary">Please use this One time Password for verification!!</p>
                <p>
                    <a href="{{url('otpverifypage')}}">Go to here</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>