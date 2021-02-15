@extends('admin.layouts.master')
@section('title','Users')
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
@stop
@section('content')
<div class="container-fluid  dashboard-content">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">User List
                        <a class="headerbuttonforAdd" href="{{route('admin.user.create')}}">
                            <i class="fa fa-plus" aria-hidden="true"></i>Add User
                        </a>
                    </h5>
                    <!-- <p>This example shows FixedHeader being styled by the Bootstrap 4 CSS framework.</p> -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example4" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td style="height: 100px; width: 100px"><img height="100px" width="100px" src="{{$user->image}}"></td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->mobile}}</td>
                                        <td>
                                            <?php $action = 'Block';
                                                if($user->status != 1){
                                                    $action = 'Unblock';
                                                }
                                            ?>
                                            <a href="javascript:void(0)" class="blockUnblock" data-id="{{$user->id}}">{{$action}}</a> | <a href="javascript:void(0)" class="text-danger userDelete" data-id="{{$user->id}}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example4').DataTable();
        });
        $(document).on('click','.userDelete',function(){
            var userId = $(this).attr('data-id');
            var thisClickedbtn = $(this);
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this user!",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    allinOneManageUsers(userId,'delete',thisClickedbtn)
                }
            });
        });

        $(document).on('click','.blockUnblock',function(){
            var userId = $(this).attr('data-id');
            var thisClickedbtn = $(this);
            var action = 'unblock';
            if(thisClickedbtn.text() == 'Block'){
                action = 'block';
            }
            allinOneManageUsers(userId,action,thisClickedbtn);
        });

        function allinOneManageUsers(userId,action,clickedBtn)
        {
            $.ajax({
                type:'POST',
                dataType:'JSON',
                url:"{{route('admin.user.manageUser')}}",
                data: {userId:userId,action:action,'_token': $('input[name=_token]').val()},
                success:function(data){
                    if(data.error == false){
                        if(action == 'delete'){
                            clickedBtn.closest('tr').remove();
                            swal('Success',"Poof! Your user has been deleted!");
                        }else{
                            if(action == 'block'){
                                clickedBtn.text('Unblock');
                            }else{
                                clickedBtn.text('Block');
                            }
                        }
                    }else{
                        swal('Error',data.message);
                    }
                }
            });
        }

    </script>
@stop
@endsection
