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
                    <h2>addresses</h2>
                </div> 
                @if ($addresses == null || $admin == 1)
                    <div>
                        <a href="{{ route('addresses.create') }}" class="btn btn-success">create addresses</a>
                    </div>
                @else<div>

                    </div>
                @endif

                @if ($messege = Session::get('success'))
                    <div class="alert alert-success">
                        <p> {{ $messege }}</p>
                    </div>
                @endif

                <table class="table table-bordered">
                    <tr>
                        <th>No.</th>
                        <th>Detail</th>
                        <th>Reference</th>
                        <th width="280px">Action</th>
                    </tr>

                    @foreach ($addresses as $addressesDetail)
                        <tr>
                            <td>{{ $addressesDetail->id }}</td>
                            <td>{{ $addressesDetail->detail }}</td>
                            <td>{{ $addressesDetail->reference }}</td>
                            <td>
                                <form id="deleteForm">
                                    <a href="{{ route('addresses.edit', $addressesDetail->id) }}">Edit</a>


                                </form>

                            </td>
                        </tr>
                    @endforeach

                </table>
                {{-- {!! $addresses->links('pagination::bootstrap-5') !!} --}}
            </div>
        </div>
    @endsection


</body>

</html>
