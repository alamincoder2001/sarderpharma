@extends("layouts.app")

@section("title", "Admin CompanyContact Page")

@section("content")
<div class="row d-flex justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="example" class="table">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key=>$item)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->message}}</td>
                            <td>
                                Action
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push("js")
    <script>
        $("#example").DataTable();
    </script>
@endpush