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
                        <a class="nav-link" href="{{ url('admin/dashboard')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('admin/createdepartment')}}">Create new department</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('admin/listofemployee')}}">List of Teacher</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('logout')}}">Logout</a>
                    </li>

                </ul>
            </nav>
        </div>
    </header>
    <section class="container">
        @if(session()->has('success'))
            <div class="alert alert-primary alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Success!</strong> {{ session()->get('success')  }}
            </div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>Role</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Verify Status</td>
                    <td>Action</td>
                </tr>

            </thead>
            <tbody>
                @foreach($e as $i)
                @if(($i->status) ==0)
                <tr>
                    <td>{{$i->role}}</td>
                    <td>{{$i->name}}</td>
                    <td>{{$i->email}}</td>
                    <td>{{($i->verified)==0?'Not Verified Yet':'Verified'}}</td>
                    <td>
                        <a href="{{url('admin/listofemployee/pending/'.$i->id)}}" class="btn btn-primary">Pending</a>
                        <a href="#" class="btn btn-danger">Delete Request</a>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </section>

</body>

</html>