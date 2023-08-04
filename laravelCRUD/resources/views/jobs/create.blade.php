<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Create Job</title>
</head>

<body>
    @section('content')
        <div class="container mt-2">
            @extends('layouts.app')
            <div class="row">
                <div class="col-lg-12">
                    <h2>Add job</h2>
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
                    <form id="submitForm">
                        <div id="name-group" class="form-group">
                            <label for="name">Detail</label>
                            <input type="text" class="form-control" id="detail" name="detail" placeholder="Detail" />
                        </div>

                        <div id="email-group" class="form-group">
                            <label for="email">Reference</label>
                            {{-- <input type="text" class="form-control" id="reference" name="reference"
                                placeholder="reference" /> --}}
                            <select id="reference" name="reference" class="js-example-basic-multiple js-states form-control" id="members">
                                @foreach ($user as $userDetail)
                                    <option id="reference" name="reference" value='{{ $userDetail->email }}'>{{ $userDetail->email }}</option>
                                @endforeach
                            </select>

                        </div>




                        <button type="submit" class="btn btn-success" id="submitBtn">
                            Submit
                        </button>
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


            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                var formData = $('#submitForm')[0]
                console.log('formData', formData);



                // $('#submitBtn').html('submit success');

                $('#submitBtn').click(function(e) {

                    var form = new FormData(formData)
                    console.log('form', form);

                    console.log('i am called');



                    event.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: '{{ route('jobs.store') }}',
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'JSON',
                        data: form,

                        // data: {
                        //     detail: detail,
                        //     reference: reference,
                        // },
                        // success: function(response) {
                        //     alert(response);
                        // }

                        error: function(error) {

                            alert("datail is require");

                            console.log(error);

                        },
                        success: function(response) {
                            window.location = '/jobs';
                        }
                    });
                    event.preventDefault();



                })
                // $("form").submit(function(event) {
                //     var formData = {
                //         detail: $("#detail").val(),
                //         reference: $("#reference").val(),
                //     };




                //     event.preventDefault();
                // });
            });
        </script>


</body>

</html>
