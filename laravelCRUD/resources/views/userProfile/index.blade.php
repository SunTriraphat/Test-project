<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Home page</title>
</head>

<body>
    @section('content')
    <div class="container mt-2">
        @extends('layouts.app')
        <div class="row">
            <div class="col-lg-12">
                <h2>User</h2>
            </div>
            <div>
                <a href="{{ route('userProfile.create') }}" class="btn btn-success">create user</a>
            </div>

            @if ($messege = Session::get('success'))
                <div class="alert alert-success">
                    <p> {{ $messege }}</p>
                </div>
            @endif

            <table class="table table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th width="280px">Action</th>
                </tr>

                @foreach ($userProfile as $userDetail)
                    <tr>
                        <td>{{ $userDetail->id }}</td>
                        <td>{{ $userDetail->name }}</td>
                        <td>{{ $userDetail->email }}</td>
                        <td>
                            <form id="deleteForm">
                                <a href="{{ route('userProfile.edit', $userDetail->id) }}">Edit</a>
                               

                            </form>

                        </td>
                    </tr>
                @endforeach

            </table>
            {!! $userProfile->links('pagination::bootstrap-5') !!}
        </div>
    </div>
    @endsection
    

</body>

</html>
