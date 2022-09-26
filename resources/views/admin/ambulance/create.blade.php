@extends("layouts.app")

@section("title", "Admin Ambulance Create Page")

@section("content")

<div class="row d-flex justify-content-center">

    <div class="col-md-10">
        <div class="card">
            <div class="card-heading text-end">
                <div class="card-title">
                    <a href="{{route('admin.ambulance.index')}}" class="btn btn-danger px-3">Back To Home</a>
                </div>
            </div>
            <div class="card-body p-3">
                <form id="addAmbulance">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Ambulance Service Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Ex: SA Ambulance">
                                <span class="error-name text-danger error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Ex: Username">
                                <span class="error-username text-danger error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Ex: example@gmail.com">
                                <span class="error-email text-danger error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password">
                                <span class="error-password text-danger error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <div class="input-group">
                                    <i class="btn btn-secondary">+88</i><input type="text" name="phone" id="phone" class="form-control" placeholder="01737484046">
                                    <span class="error-phone text-danger error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ambulance_type">Type Of Ambulance</label>
                                <select multiple name="ambulance_type[]" id="ambulance_type" class="form-control select2">
                                    <option label="Choose ambulance type"></option>
                                    <option value="ICU">ICU Ambulance</option>
                                    <option value="NICU">Non ICU Ambulance</option>
                                    <option value="Freezing">Freezing Ambulance</option>
                                    <option value="AC">AC Ambulance</option>
                                </select>
                                <span class="error-ambulance_type text-danger error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city_id">City Name</label>
                                <select name="city_id" id="city_id" class="form-control select2">
                                    <option value="">Choose a city name</option>
                                    @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="error-city_id text-danger error"></span>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" id="address" class="form-control"></textarea>
                                <span class="error-address text-danger error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="map_link">Map Link</label>
                                <textarea name="map_link" id="map_link" class="form-control"></textarea>
                                <span class="error-map_link text-danger error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="image">Ambulance Image</label>
                                <input type="file" class="form-control" id="image" name="image" onchange="document.querySelector('.img').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <img width="100" class="img" style="border: 1px solid #ccc; height:80px;">
                        </div>
                    </div>
                    <div class="form-group text-center mt-3">
                        <button type="submit" class="btn btn-success text-white text-uppercase px-3">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push("js")
<script>
    $(document).ready(() => {

        $('.select2').select2();
        
        $("#addAmbulance").on("submit", (event) => {
            event.preventDefault()
            var formdata = new FormData(event.target)
            $.ajax({
                url: "{{route('admin.ambulance.store')}}",
                data: formdata,
                method: "POST",
                dataType: "JSON",
                contentType: false,
                processData: false,
                beforeSend: () => {
                    $("#addAmbulance").find(".error").text("");
                },
                success: (response) => {
                    if (response.error) {
                        $.each(response.error, (index, value) => {
                            $("#addAmbulance").find(".error-" + index).text(value);
                        })
                    } else {
                        $("#addAmbulance").trigger('reset')
                        $.notify(response, "success");
                    }
                }
            })
        })
    })
</script>
@endpush