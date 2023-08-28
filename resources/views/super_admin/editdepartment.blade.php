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
    <div class="container">
        @if(session()->has('success'))
        <div class="alert alert-primary alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> {{ session()->get('success')  }}
        </div>
        @endif
        @if(session()->has('Error'))
        <div class="alert alert-primary alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Failed!</strong> {{ session()->get('Error')  }}
        </div>
        @endif

        <form method="post" action="{{url('admin/updatedepartment/'.$d->id)}}">
            @csrf

            <div class="form-group">
                <label>Department Name :</label>
                <input type="text" name="name" value="{{$d->name}}" required class="form-control">
            </div>
            <div class="form-group">
                <label>Short aliases :</label>
                <input type="text" name="aliases" value="{{$d->aliase}}" required class="form-control">
            </div>

            <div class="form-group">
                <label>Assign Department Admin:</label>
                <select class="form-control" name="admin">
                    <option>Choose department admin</option>
                    @foreach($e as $i)
                        @if(($i->role) == 'department-admin')
                          <option {{($i->name)==($d->admin)?'selected':''}} value="{{$i->name}}">{{$i->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Edit</button>

                <a href="{{url('admin/listofdepartment')}}" class="btn btn-info"> See existing department</a>
            </div>
        </form>
    </div>

</body>

</html>