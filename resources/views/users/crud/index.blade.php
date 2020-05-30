@extends('layouts.admin.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Users</h3>

                    <div class="card-tools">
{{--                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>--}}
{{--                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                        <button class="btn btn-block btn-outline-success btn-sm" data-toggle="modal" data-target="#modal-lg">
                            <i class="fa fa-user-plus"></i>&ensp;<b>Add More</b>
                        </button>
                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    <table id="example3" class="table table-striped elevation-4">
                        <thead>
                        <tr>
                            <th class="text-center">&ensp; ID</th>
                            <th>Name</th>
                            <th>CI</th>
                            <th>Profile</th>
                            <th>Gender</th>
                            <th>Phone Number</th>
                            <th>Birthday</th>
                            <th>User</th>
                            <th class="text-center">Password</th>
                            <th>Status</th>
                            <th>Role</th>
                            <th class="text-right">Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th class="text-center">{{$user->id}}</th>
                                <td>{{$user->full_name}}</td>
                                <td>{{$user->ci}}</td>
                                <td class="text-center">
                                    <img alt="Avatar" style="width: 35px; height: 35px;" class="table-avatar img-circle elevation-4" src="{{asset("/admin-lte/dist/img/avatar5.png")}}"/>
                                </td>
                                @if($user->gender == 'F')
                                    <td>Female</td>
                                @else
                                    <td>Male</td>
                                @endif
                                <td>{{$user->phone_number}}</td>
                                <td>{{$user->birthday}}</td>
                                <td>{{$user->user}}</td>
{{--                                for password--}}
                                <td class="py-1 align-middle text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('users.show',$user->id) }}" class="btn bg-danger elevation-2" data-toggle="modal" data-target="#modal-user-show-password{{$user->id}}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                                @if($user->active == 1)
                                    <td class="project-state">
                                        <span class="badge badge-success elevation-3">Active</span>
                                    </td>
                                @else
                                    <td class="project-state">
                                        <span class="badge badge-danger elevation-3">Inactive</span>
                                    </td>
                                @endif
                                <td><b>{{$user->role}}</b></td>
                                <td class="py-0 align-middle text-right">
                                    <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('users.show',$user->id) }}" class="btn btn-info float-right elevation-2" data-toggle="modal" data-target="#modal-user-show{{$user->id}}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('users.edit',$user->id) }}" class="btn btn-warning elevation-2" data-toggle="modal" data-target="#modal-user-edit{{$user->id}}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger elevation-2"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
{{--                            MODAL FOR EDIT FORM--}}
                            <div class="modal fade" id="modal-user-edit{{$user->id}}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content card-primary card-outline">
                                        <div class="modal-header">
                                            <b class="modal-title">Add More Users</b>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{route('users.update',$user->id)}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body small">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>CI</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                                                                </div>
                                                                <input type="number" name="ci" class="form-control" placeholder="CI" value="{{$user->ci}}">
                                                            </div>
                                                        </div>
                                                        <!-- /.form-group -->
                                                        <div class="form-group">
                                                            <label>First Name</label>
                                                            <input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{$user->first_name}}">
                                                        </div>
                                                        <!-- /.form-group -->
                                                        <div class="form-group">
                                                            <label>Second Name</label>
                                                            <input type="text" name="second_name" class="form-control" placeholder="Second Name" value="{{$user->second_name}}">
                                                        </div>
                                                        <!-- /.form-group -->
                                                        <div class="form-group">
                                                            <label>Last Name</label>
                                                            <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{$user->last_name}}">
                                                        </div>
                                                        <!-- /.form-group -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Mother Last Name</label>
                                                            <input type="text" name="mother_last_name" class="form-control" placeholder="Mother Last Name" value="{{$user->mother_last_name}}">
                                                        </div>
                                                        <!-- /.form-group -->
                                                        <div class="form-group">
                                                            <label>Phone Number</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                                </div>
                                                                <input type="number" name="phone_number" class="form-control" placeholder="Phone Number" value="{{$user->phone_number}}">
                                                            </div>
                                                        </div>
                                                        <!-- /.form-group -->
                                                        <div class="form-group">
                                                            <label>Gender</label>
                                                            <div class="form-group clearfix">
                                                                @if($user->gender == 'M')
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" name="gender" id="radioPrimary1"  value="M" checked>
                                                                        <label for="radioPrimary1">Male</label>
                                                                    </div>
                                                                    &ensp;&ensp;
                                                                    <div class="icheck-info d-inline">
                                                                        <input type="radio" name="gender" id="radioPrimary2" value="F">
                                                                        <label for="radioPrimary2">Female</label>
                                                                    </div>
                                                                @else
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" name="gender" id="radioPrimary1"  value="M">
                                                                        <label for="radioPrimary1">Male</label>
                                                                    </div>
                                                                    &ensp;&ensp;
                                                                    <div class="icheck-info d-inline">
                                                                        <input type="radio" name="gender" id="radioPrimary2" value="F" checked>
                                                                        <label for="radioPrimary2">Female</label>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- /.form-group -->
                                                        <div class="form-group">
                                                            <label>Birthday</label>
                                                            <div class="input-group mb-3">
                                                                <input type="date" name="birthday" class="form-control" placeholder="Birthday" value="{{$user->birthday}}">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- /.form-group -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>User</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" name="user" class="form-control" placeholder="User" value="{{$user->user}}">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- /.form-group -->
                                                        <div class="form-group">
                                                            <label>Password</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" name="password" class="form-control" placeholder="Password" value="{{$user->password}}">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- /.form-group -->
                                                        <div class="form-group">
                                                            <label>Role</label>
                                                            <select class="form-control select2" name="role_id" style="width: 100%;">
{{--                                                                <option selected="selected">Select a role</option>--}}
                                                                @foreach($roles as $role)
                                                                    @if($user->role == $role->role)
                                                                        <option selected value="{{$role->id}}">{{$role->role}}</option>
                                                                    @else
                                                                        <option value="{{$role->id}}">{{$role->role}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <!-- /.form-group -->
                                                        <div class="form-group">
                                                            <label>Active</label>
                                                            <div class="form-group clearfix">
                                                                @if($user->active ==1)
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" name="active" id="radioSuccess1"  value="1" checked>
                                                                        <label for="radioSuccess1">Active</label>
                                                                    </div>
                                                                    &ensp;&ensp;
                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" name="active" id="radioSuccess2" value="0">
                                                                        <label for="radioSuccess2">Inactive</label>
                                                                    </div>
                                                                @else
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" name="active" id="radioSuccess1"  value="1">
                                                                        <label for="radioSuccess1">Active</label>
                                                                    </div>
                                                                    &ensp;&ensp;
                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" name="active" id="radioSuccess2" value="0" checked>
                                                                        <label for="radioSuccess2">Inactive</label>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- /.form-group -->
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
{{--                            MODAL FOR SHOW USER--}}
                            <div class="modal fade" id="modal-user-show{{$user->id}}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content card-primary card-outline">
                                        <div class="modal-header">
                                            <b class="modal-title">Show User</b>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card bg-light">
                                                <div class="card-header text-muted border-bottom-0">
                                                    {{$user->role}}
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h1 class="lead"><b>{{$user->full_name}}</b></h1>
                                                            @if($user->gender == 'F' || $user->active == 1)
                                                                <p class="text-muted text-sm mt-2"><b>About: </b> CI: {{$user->ci}} / Female / {{$user->role}} / Active</p>
                                                            @else
                                                                <p class="text-muted text-sm mt-2"><b>About: </b> CI: {{$user->ci}} / Male / {{$user->role}} / Inactive</p>
                                                            @endif
                                                            <ul class="ml-4 mb-lg-2 fa-ul text-muted">
{{--                                                               pendiente <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>--}}
                                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 591 - {{$user->phone_number}}</li>
                                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-birthday-cake"></i></span> Birthday: {{$user->birthday}}</li>
                                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-user"></i></span> User:  {{$user->user}}</li>
                                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-key"></i></span> Password:  {{$user->password}}</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-5 text-center">
                                                            <img src="{{asset("/admin-lte/dist/img/avatar5.png")}}" alt="" class="img-circle img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
{{--                                                    I need empty--}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button class="btn btn-danger" data-dismiss="modal">Close</button>
{{--                                            <button class="btn btn-primary">Save Changes</button>--}}
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
{{--                            MODAL FOR SHOW PASSWORD USER--}}
                            <div class="modal fade" id="modal-user-show-password{{$user->id}}">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content card-primary card-outline">
                                        <div class="modal-body">
                                            <b>Password:</b><br>
                                            {{$user->password}}
                                        </div>
                                        <div class="modal-footer float-right small">
                                            <button class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th class="text-center">&ensp; ID</th>
                            <th>Name</th>
                            <th>CI</th>
                            <th>Profile</th>
                            <th>Gender</th>
                            <th>Phone Number</th>
                            <th>Birthday</th>
                            <th>User</th>
                            <th class="text-center">Password</th>
                            <th>Status</th>
                            <th>Role</th>
                            <th class="text-right">Opciones</th>
                        </tr>
                        </tfoot>
                    </table>
{{--                    <div class="card-link float-right">{{$users->links()}}</div>--}}
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.container-fluid -->
{{--        Modal Users--}}
        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content card-primary card-outline">
                    <div class="modal-header">
                        <b class="modal-title">Add More Users</b>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('users.store')}}" method="POST">
                        @csrf
                        <div class="modal-body small">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>CI</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                                            </div>
                                            <input type="number" name="ci" class="form-control" placeholder="CI" required>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label>Second Name</label>
                                        <input type="text" name="second_name" class="form-control" placeholder="Second Name" required>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mother Last Name</label>
                                        <input type="text" name="mother_last_name" class="form-control" placeholder="Mother Last Name" required>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="number" name="phone_number" class="form-control" placeholder="Phone Number" required>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="radio" name="gender" checked="" value="M" id="radioDanger1" required>
                                                <label for="radioDanger1"> Male </label>
                                            </div>
                                            <div class="icheck-info d-inline">
                                                <input type="radio" name="gender" value="F" id="radioDanger2" required>
                                                <label for="radioDanger2"> Female </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label>Birthday</label>
                                        <div class="input-group mb-3">
                                            <input type="date" name="birthday" class="form-control" placeholder="Birthday" required>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-4">
{{--                                    <div class="form-group">--}}
{{--                                        <label>User</label>--}}
{{--                                        <div class="input-group mb-3">--}}
{{--                                            <input type="text" name="user" class="form-control" placeholder="User" required>--}}
{{--                                            <div class="input-group-prepend">--}}
{{--                                                <span class="input-group-text"><i class="fas fa-user"></i></span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <!-- /.form-group -->
{{--                                    <div class="form-group">--}}
{{--                                        <label>Password</label>--}}
{{--                                        <div class="input-group mb-3">--}}
{{--                                            <input type="password" name="password" class="form-control" placeholder="Password" required>--}}
{{--                                            <div class="input-group-prepend">--}}
{{--                                                <span class="input-group-text"><i class="fas fa-key"></i></span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select class="form-control select2" name="role_id" style="width: 100%;" required>
                                            <option selected="selected">Select a role</option>
                                            @foreach($roles as $role)
                                                <option required value="{{$role->id}}">{{$role->role}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button class="btn btn-default" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary">Save User</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </section>
@endsection

@section('alert_validations')
    <script type="text/javascript">
        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000
            });
            // if user deleted
            var msgdelete = '{{\Illuminate\Support\Facades\Session::get('success')}}';
            var existdelete = '{{\Illuminate\Support\Facades\Session::has('success')}}';
            if (existdelete){
                Toast.fire({
                    type: 'success',
                    title: msgdelete
                })
            }
            // if exist some errors
            var msg = '{{\Illuminate\Support\Facades\Session::get('error')}}';
            var exist = '{{\Illuminate\Support\Facades\Session::has('error')}}';
            if (exist){
                Toast.fire({
                    type: 'error',
                    title: msg
                })
            }
            // if exist some user in session
            var msgsession = '{{\Illuminate\Support\Facades\Session::get('error')}}';
            var existseecion = '{{\Illuminate\Support\Facades\Session::has('error')}}';
            if (existseecion){
                Toast.fire({
                    type: 'error',
                    title: msgsession
                })
            }

            // error user ci
            var msgci = '{{Session::get('error')}}';
            var existci = '{{Session::has('error')}}';
            if (existci){
                Toast.fire({
                    type: 'error',
                    title: msgci
                })
            }
        });
    </script>

@endsection
