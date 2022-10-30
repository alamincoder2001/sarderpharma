@extends("layouts.app")

@section("title", "Admin Privatecar Edit Page")
@push("style")
<style>
    .select2-container .select2-selection--single {
        height: 34px !important;
    }

    .select2-selection select2-selection--multiple {
        height: 34px !important;
    }
</style>
@endpush
@section("content")

<div class="row d-flex justify-content-center">

    <div class="col-md-10">
        <div class="card">
            <div class="card-heading text-end">
                <div class="card-title">
                    <a href="{{route('admin.privatecar.index')}}" class="btn btn-danger px-3">Back To Home</a>
                </div>
            </div>
            <div class="card-body p-3">
                <form id="updatePrivatecar">
                    <input type="hidden" id="id" name="id" value="{{$data->id}}">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Privatecar Service Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{$data->name}}">
                                <span class="error-name text-danger error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{$data->email}}">
                                <span class="error-email text-danger error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <div class="input-group">
                                    <p class="btn btn-secondary m-0">+88</p><input type="text" name="phone" id="phone" class="form-control" value="{{$data->phone}}">
                                    <span class="error-phone text-danger error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            @php
                            $car = explode(",", $data->cartype_id);
                            @endphp
                            <div class="form-group">
                                <label for="cartype_id">Type Of Privatecar</label>
                                <div class="input-group">
                                    <select multiple name="cartype_id[]" id="cartype_id" class="form-control select2">
                                        @foreach(App\Models\Cartype::latest()->get() as $item)
                                        <option value="{{$item->id}}" {{in_array("$item->id", $car)?"selected":""}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <span onclick="PrivateCar(event)" class="btn btn-dark">+</span>
                                </div>
                                <span class="error-cartype_id text-danger error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city_id">City Name</label>
                                <select name="city_id" id="city_id" class="form-control select2">
                                    <option value="">Choose a city name</option>
                                    @foreach($cities as $city)
                                    <option value="{{$city->id}}" {{$data->city_id==$city->id?"selected":""}}>{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="error-city_id text-danger error"></span>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" id="address" class="form-control">{{$data->address}}</textarea>
                                <span class="error-address text-danger error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="map_link">Map Link</label>
                                <textarea name="map_link" id="map_link" class="form-control">{{$data->map_link}}</textarea>
                                <span class="error-map_link text-danger error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="image">Privatecar Image</label>
                                <input type="file" class="form-control" id="image" name="image" onchange="document.querySelector('.img').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <img src="{{asset($data->image)}}" width="100" class="img" style="border: 1px solid #ccc; height:80px;">
                        </div>
                    </div>
                    <div class="form-group text-center mt-3">
                        <button type="submit" class="btn btn-primary text-white text-uppercase px-3">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Car Type Name</h5>
            </div>
            <form id="formPrivatecar">
                <input type="hidden" name="car_id" id="car_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Car Name</label>
                        <input type="text" name="name" class="form-control" id="name">
                        <span class="error-name error text-danger"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push("js")
<script>
    $(document).ready(() => {
        $('.select2').select2();

        $("#updatePrivatecar").on("submit", (event) => {
            event.preventDefault()
            var formdata = new FormData(event.target)
            $.ajax({
                url: "{{route('admin.privatecar.update')}}",
                data: formdata,
                method: "POST",
                contentType: false,
                processData: false,
                beforeSend: () => {
                    $("#updatePrivatecar").find(".error").text("");
                },
                success: (response) => {
                    if (response.error) {
                        $.each(response.error, (index, value) => {
                            $("#updatePrivatecar").find(".error-" + index).text(value);
                        })
                    } else {
                        $("#updatePrivatecar").trigger('reset')
                        $.notify(response, "success");
                        window.location.href = "{{route('admin.privatecar.index')}}"
                    }
                }
            })
        })
    })

    function PrivateCar(event) {
        $("#myModal").modal("show")
    }

    $("#formPrivatecar").on("submit", event => {
        event.preventDefault()
        var name = $("#myModal").find("#formPrivatecar #name").val()
        var id = $("#myModal").find("#formPrivatecar #car_id").val()
        $.ajax({
            url: location.origin + "/admin/cartype",
            method: "POST",
            data: {
                car_id: id,
                name: name
            },
            beforeSend: () => {
                $("#myModal").find("#formPrivatecar .error").text("")
            },
            success: res => {
                if (res.error) {
                    $.each(res.error, (index, value) => {
                        $("#myModal").find("#formPrivatecar .error-" + index).text(value)
                    })
                } else {
                    $("#myModal").modal("hide")
                    $.notify(res.msg, "success")
                    $("#formPrivatecar").trigger('reset')
                    $("#cartype_id").append(`<option value="${res.id}">${name}</option>`);
                }
            }
        })
    })
</script>
@endpush