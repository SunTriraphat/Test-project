<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Edit Job</title>
</head>

<body>
    @section('content')
    <div class="container mt-2">
        @extends('layouts.app')
        <div class="row">
            <div class="col-lg-12">
                <h2>Edit job</h2>
            </div>
            <div>
                <a href="{{ route('jobs.index') }}" class="btn btn-primary">Back</a>
            </div>

            {{-- @if (session('status'))
                <div class="alert alert">
                    {{ session('status') }}
                </div>
            @endif --}}
            <div class="col-sm-6 col-sm-offset-3">
                @if ($messege = Session::get('success'))
                    <div class="alert alert-success">
                        <p> {{ $messege }}</p>
                    </div>
                @endif
                {{-- <form id="editForm" action="{{route('jobs.update',$job->id)}}" method="POST"> --}}
                <form id="editForm">
                    @csrf
                    @method('PUT')
                    <div id="name-group" class="form-group">
                        <input type="hidden" name="job_id" id="job_id" value="{{ $job->id }}">
                        <label for="name">Detail</label>
                        <input type="text" value="{{ $job->detail }}" class="form-control" id="detail"
                            name="detail" placeholder="Detail" />
                    </div>

                    <div id="email-group" class="form-group">
                        <label for="email">Reference</label>
                        <select id="reference" name="reference" class="js-example-basic-multiple js-states form-control" id="members">
                            @foreach ($user as $userDetail)
                                <option id="reference" name="reference" value='{{ $userDetail->email }}'>{{ $userDetail->email }}</option>
                            @endforeach
                        </select>
                    </div>



                    <button type="submit" class="btn btn-success" id="editBtn">
                        Edit
                    </button>
                    <button class="btn btn-danger" id="destroyBtn">Delete</button>
                </form>
            </div>

            {{-- <form id="submitform" onsubmit="submitData()">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mt-3" >
                            <strong>
                                Datail
                            </strong>
                            <input type="text" class="form-control" name="detail" placeholder="datail">
                        </div>
                        @error('name')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mt-3">
                            <strong>
                                Reference
                            </strong>
                            <input type="text" class="form-control" name="reference" placeholder="reference">
                        </div>
                        @error('reference')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12">

                    <button style="float: right;" type="submit" class="btn btn-success mt-3">Submit</button>
                    </div>
                </form>
            </div> --}}
        </div>
        @endsection



        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <script>
            const params = new URLSearchParams(window.location.search)
            const currentUrl = window.location.href;
            console.log('param', params);
            console.log('currentUrl', currentUrl);


            var splitUrl = currentUrl.split('/');
            console.log('splitUrl', splitUrl);

            var id = splitUrl[4];
            console.log("id", id);


            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    Accept: "application/json",
                });


                var formData = $('#editForm')[0]
                console.log('formData', formData);



                

                $('#editBtn').click(function(e) {
                    console.log($("#detail").val());

                    var form = new FormData(formData)
                    console.log('form', form);



                    console.log('i am edit');
                    // console.log('id',$job->id);

                    var data = {
                        'id': parseInt(splitUrl[4]),
                        'detail': $("#detail").val(),
                        'reference': $("#reference").val(),
                    };

                    

                    console.log('data', data);



                   

                    e.preventDefault();
                    $.ajax({
                        headers: {
                            Accept: "application/json"
                        },
                        type: "PUT",
                        url: '{{ url('jobs', '') }}' + '/' + id + '/edit'+'/'+$("#detail").val()+'/'+$("#reference").val(),
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'JSON',
                        

                        error: function(error, errorThrown) {

                            // alert(error.responseText);
                            // alert(errorThrown);
                            alert("edit not success");
                            console.log("error");
                            console.log(error);

                        },
                        success: function(response) {
                            console.log("response");
                            console.log(response);
                            alert("edit success");
                            window.location = '/jobs';
                        }
                    });
                    e.preventDefault();




                }),
                $('#destroyBtn').click(function(e) {
                


                console.log('i am destroy');
                // console.log('id',$job->id);

                e.preventDefault();
                $.ajax({
                    headers: {
                        Accept: "application/json"
                    },
                    type: "DELETE",
                    url: '{{ url('jobs', '') }}' + '/' + id + '/destroy'  ,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'JSON',


                    error: function(error, errorThrown) {

                        // alert(error.responseText);
                        // alert(errorThrown);
                        console.log("error");
                        console.log(error);

                    },
                    success: function(response) {
                        console.log("response");
                        console.log(response);
                        alert("delete success");
                        window.location = '/jobs';
                    }
                });
                e.preventDefault();




            })
                
            });
        </script>

</body>

</html>
