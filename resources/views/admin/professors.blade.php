@extends('layouts-admin.app')
@section('content')
<style>.files input {
    outline: 2px dashed #92b0b3;
    outline-offset: -10px;
    -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
    transition: outline-offset .15s ease-in-out, background-color .15s linear;
    padding: 120px 0px 85px 35%;
    text-align: center !important;
    margin: 0;
    width: 100% !important;
}
.files input:focus{     outline: 2px dashed #92b0b3;  outline-offset: -10px;
    -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
    transition: outline-offset .15s ease-in-out, background-color .15s linear; border:1px solid #92b0b3;
 }
.files{ position:relative}
.files:after {  pointer-events: none;
    position: absolute;
    top: 60px;
    left: 0;
    width: 50px;
    right: 0;
    height: 56px;
    content: "";
    /* background-image: url(https://image.flaticon.com/icons/png/128/109/109612.png); */
    display: block;
    margin: 0 auto;
    background-size: 100%;
    background-repeat: no-repeat;
}
.color input{ background-color:#f1f1f1;}
.files:before {
    position: absolute;
    bottom: 10px;
    left: 0;  pointer-events: none;
    width: 100%;
    right: 0;
    height: 57px;
    content: " or drag it here. ";
    display: block;
    margin: 0 auto;
    color: #2ea591;
    font-weight: 600;
    text-transform: capitalize;
    text-align: center;
}</style>
    <div class="col-lg-12">
        <h4>Add Professor</h4>
        <div class="card">
            <div class="row p-2 m-0">
                <form method="post" action="#" id="#">
           
              
              
              
                    
                    
                  
                </form>
                <form class="needs-validation" novalidate action="professor" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group files">
                        <label>Upload Your File </label>
                        <input name="teacher_file" type="file" class="form-control" multiple="">
                    </div>
                    <div class="form-row">
                        {{-- <div class="col-md-4 mb-3">
                            <label for="ProfessorName">Professor Name</label>
                            <input type="text" class="form-control" id="validationCustom01" placeholder="Name"
                                required value="{{ old('name') }}" name="name">
                            <div class="invalid-feedback">
                                Please enter name
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom02">E-Mail</label>
                            <input type="email" class="form-control" id="validationCustom02" placeholder="E-mail"
                                required value="{{ old('email') }}" name="email">
                                @if (Session::has('error'))
                                <div class="invalid-feedback" style="display:inline-flex">
                                    This email is already exist, Please use another email
                                </div>
                            @endif
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please enter valid email
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustomUsername">Phone Number</label>
                            <input type="number" class="form-control" id="validationCustomUsername"
                                placeholder="Contact No" name="phone" required value="{{ old('email')}}">
                            <div class="invalid-feedback">
                                Please enter mobile no.
                            </div>
                        </div> --}}
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Sumbit</button>
                    </div>
                </form>
            </div>
        </div>
        <h4>Users</h4>
        <div class="card p-2">
            <div class="table-responsive">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th scope="col">Sr No</th>
                            <th scope="col">Name</th>
                            <th scope="col">E-Mail</th>
                            <th scope="col">Phone No</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $ind=>$user)
                            <tr>
                                <td scope="row">{{ $ind + 1 }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->contact_no }}</td>
                                <td scope="row"><button onclick="deleteUser({{ $user->id }})"
                                        class="btn btn-danger btn-sm">Delete</button></th>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('jquery')
    <script>
        $('#table_id').dataTable({
            "columnDefs": [{
                "width": "8%",
                "targets": 0,
                "className": "text-center"
            }],
            responsive: true,
        });

        function deleteUser(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax('professor/' + id, {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(data, status, xhr) {
                            console.log(data);
                            if (data.status == 200) {
                                Swal.fire({
                                    title: 'Deleted Successfully',
                                    icon: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.value) {
                                        window.location.reload()
                                    }
                                })
                            }
                        },
                        error: function(jqXhr, textStatus, errorMessage) {

                        }
                    });

                }
            })
        }
        $(document).ready(function() {
            toastr.options.timeOut = 5000;
            @if (Session::has('error'))
                toastr.error('{{Session::get('error')}}');
            @endif

            @if (Session::has('success'))
                toastr.success('{{Session::get('success')}}');
            @endif
            @if (Session::has('worng'))
                toastr.info('Ohh! Somthing Went worng Please try again');
            @endif
        });
    </script>
@endsection
