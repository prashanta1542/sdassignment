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
        <div class="m-5">
            <h2 type="submit" class="text-center">List of Department</h2>

            <a href="{{url('admin/createdepartment')}}" class="btn btn-info"> Create New Department</a>
        </div>
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
        <table class="table table-striped ">
            <thead>
                <tr>
                    <td>Department Name</td>
                    <td>Short Aliase</td>
                    <td>Admin</td>
                    <td>Action</td>
                </tr>

            </thead>
            <tbody>
                @foreach($d as $i)
                @if(($i->status) ==0)
                <tr>
                    <td>{{$i->name}}</td>
                    <td>{{$i->aliase}}</td>
                    <td>{{$i->admin}}</td>
                    <td>
                        <a href="{{url('admin/editdepartment/'.$i->id)}}" class="btn btn-primary">Edit</a>
                        <a href="#"  class="btn btn-danger" data-toggle="modal" data-target="#myModal">Delete</a>
                        <div class="modal fade" id="myModal">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        Are you sure to delete?
                                    </div>

                                    <div class="modal-footer">
                                        <a href="{{url('admin/deletedepartment/'.$i->id)}}" type="button" class="btn btn-danger" >Confirm</a>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </section>



</body>

</html>