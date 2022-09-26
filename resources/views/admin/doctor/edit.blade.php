@extends("layouts.app")

@section("title", "Admin Doctor Update Profile")

@section("content")

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-heading text-end">
                <div class="card-title">
                    <a href="{{route('admin.doctor.index')}}" class="btn btn-danger px-3">Back To Home</a>
                </div>
            </div>
            <div class="card-body">
                <form id="updateDoctor">
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <div class="personal-info px-3">
                        <h5>Personal Information</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Name <small class="text-danger">*</small></label>
                                    <input type="text" name="name" class="form-control" value="{{$data->name}}">
                                    <span class="error-name error text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="username">Username<small class="text-danger">*</small></label>
                                <input type="text" id="username" name="username" class="form-control" value="{{$data->username}}">
                                <span class="error-username text-danger"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{$data->email}}">
                                <span class="error-email text-danger"></span>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">Password<small class="text-danger">*</small></label>
                                    <div class="input-group">
                                        <input type="checkbox" id="Showpassword"><input type="password" disabled class="form-control" id="password" name="password" placeholder="Password">
                                    </div>
                                    <span class="error-password text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="phone">Phone<small class="text-danger">*</small></label>
                                <div class="input-group">
                                    <i class="btn btn-secondary">+88</i><input type="text" id="phone" name="phone" class="form-control" value="{{$data->phone}}">
                                </div>
                                <span class="error-phone error text-danger"></span>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="education">Education<small class="text-danger">*</small></label>
                                    <input type="text" name="education" class="form-control" value="{{$data->education}}">
                                    <span class="error-education error text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="department_id">Specialist<small class="text-danger">*</small></label>
                                    <select name="department_id" id="department_id" class="form-control select2">
                                        <option value="">Choose a Speciality</option>
                                        @foreach($departments as $department)
                                        <option value="{{$department->id}}" {{$department->id==$data->department_id?"selected":""}}>{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="error-department_id error text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city_id">City Name<small class="text-danger">*</small></label>
                                    <select name="city_id" id="city_id" class="form-control select2">
                                        <option value="">Choose a city name</option>
                                        @foreach($cities as $city)
                                        <option value="{{$city->id}}" {{$city->id==$data->city_id?"selected":""}}>{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="error-city_id text-danger error"></span>
                            </div>
                            <div class="col-md-2">
                                <label for="first_fee">First Fee<small class="text-danger">*</small></label>
                                <input type="number" id="first_fee" name="first_fee" class="form-control" value="{{$data->first_fee}}">
                                <span class="error-first_fee error text-danger"></span>
                            </div>
                            <div class="col-md-2">
                                <label for="second_fee">Second Fee<small class="text-danger">*</small></label>
                                <input type="number" id="second_fee" name="second_fee" class="form-control" value="{{$data->second_fee}}">
                                <span class="error-second_fee error text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="personal-info px-3 mb-3">
                        <h5>Availability</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="availability">Availability Day <small class="text-danger">*</small></label>
                                    <div class="input-group gap-2">
                                        <input type="checkbox" id="sat" {{in_array("sat", $avail)?"checked":""}} name="availability[]" value="sat" /><label>Saturday</label>
                                        <input type="checkbox" id="sun" {{in_array("sun", $avail)?"checked":""}} name="availability[]" value="sun" /><label>Sunday</label>
                                        <input type="checkbox" id="mon" {{in_array("mon", $avail)?"checked":""}} name="availability[]" value="mon" /><label>Monday</label>
                                        <input type="checkbox" id="tue" {{in_array("tue", $avail)?"checked":""}} name="availability[]" value="tue" /><label>Tuesday</label><br>
                                        <input type="checkbox" id="wed" {{in_array("wed", $avail)?"checked":""}} name="availability[]" value="wed" /><label>Wednessday</label>
                                        <input type="checkbox" id="thu" {{in_array("thu", $avail)?"checked":""}} name="availability[]" value="thu" /><label>Thursday</label>
                                        <input type="checkbox" id="fri" {{in_array("fri", $avail)?"checked":""}} name="availability[]" value="fri" /><label>Friday</label>
                                    </div>
                                    <span class="error-availability error text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="from">From<small class="text-danger">*</small></label>
                                <input type="time" id="from" name="from" class="form-control" value="{{$data->from}}">
                                <span class="error-from error text-danger"></span>
                            </div>
                            <div class="col-md-2">
                                <label for="to">To<small class="text-danger">*</small></label>
                                <input type="time" id="to" name="to" class="form-control" value="{{$data->to}}">
                                <span class="error-to error text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <!-- hospital && diagnostic && chamber -->
                    <div class="chamber-info px-3">
                        <h5>Select Chamber Or Hospital Or Diagnostic</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Choose a module</label>
                                    <select class="form-control changeModule">
                                        <option value="">Select Chamber Or Hospital Or Diagnostic</option>
                                        <option value="chamber">Chamber</option>
                                        <option value="hospital">Hospital</option>
                                        <option value="diagnostic">Diagnostic</option>
                                    </select>
                                </div>
                            </div>
                            <div id="chamber" class="col-md-8 row {{$data->chamber_name?'':'d-none'}}">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="chamber_name">Chamber Name</label>
                                        <input type="text" name="chamber_name" class="form-control" value="{{$data->chamber_name}}">
                                        <span class="error-chamber_name error text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea name="address" class="form-control">{{$data->address}}</textarea>
                                        <span class="error-address error text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div id="hospital" class="col-md-8 row {{$data->hospital_id?'':'d-none'}}">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hospital_id">Hospital Name</label>
                                        <select multiple name="hospital_id[]" id="hospital_id" class="select1 form-control">
                                            <option label="Choose Hospital"></option>
                                            @php
                                                $hosparr = explode(",",$data->hospital_id);
                                                $diagarr = explode(",",$data->diagnostic_id);
                                            @endphp
                                            @foreach($hospitals as $item)
                                            <option value="{{$item->id}}" {{in_array($item->id, $hosparr)?"selected":""}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="error-hospital_id error text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div id="diagnostic" class="col-md-8 row {{$data->diagnostic_id?'':'d-none'}}">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="diagnostic_id">Diagnostic Name</label>
                                        <select multiple name="diagnostic_id[]" id="diagnostic_id" class="select1 form-control">
                                            <option label="Choose Diagnostic"></option>
                                            @foreach($diagnostics as $item)
                                            <option value="{{$item->id}}" {{in_array($item->id, $diagarr)?"selected":""}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="error-diagnostic_id error text-danger"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="img-info px-3">
                        <hr>
                        <div class="row d-flex align-items-center">
                            <div class="col-md-3">
                                <div class="image">
                                    <img width="100" class="img" height="100" src="{{asset($data->image)}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="image">Doctor Image</label>
                                    <input type="file" class="form-control" id="image" name="image" onchange="document.querySelector('.img').src = window.URL.createObjectURL(this.files[0])">
                                    <span class="error-image text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group text-center mt-3">
                        <hr>
                        <button type="submit" class="btn btn-primary text-white text-uppercase px-3">Update</button>
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
        $('.select1').select2();

        $("#Showpassword").on("click", (event) => {
            if(event.target.checked){
                $("#password").attr("disabled", false)
            }else{
                $("#password").attr("disabled", true)
            }
        })

        $(document).on("change", ".changeModule", (event) => {
            if (event.target.value == "chamber") {
                $("#chamber").removeClass("d-none")
                $("#hospital").addClass("d-none")
                $("#diagnostic").addClass("d-none")
            } else if (event.target.value == "hospital") {
                $("#chamber").addClass("d-none")
                $("#hospital").removeClass("d-none")
                $("#diagnostic").addClass("d-none")
                $('.select1').select2();
            } else if (event.target.value == "diagnostic") {
                $("#chamber").addClass("d-none")
                $("#hospital").addClass("d-none")
                $("#diagnostic").removeClass("d-none")
                $('.select1').select2();
            } else {
                $("#chamber").addClass("d-none")
                $("#hospital").addClass("d-none")
                $("#diagnostic").addClass("d-none")
            }
        })
        
        $("#updateDoctor").on("submit", (event) => {
            event.preventDefault()
            var formdata = new FormData(event.target)
            $.ajax({
                url: "{{route('admin.doctor.update')}}",
                data: formdata,
                method: "POST",
                dataType: "JSON",
                contentType: false,
                processData: false,
                beforeSend: () => {
                    $("#updateDoctor").find(".error").text("");
                },
                success: (response) => {
                    if (response.error) {
                        $.each(response.error, (index, value) => {
                            $("#updateDoctor").find(".error-" + index).text(value);
                        })
                    } else {
                        $.notify(response, "success");
                        window.location.href = "{{route('admin.doctor.index')}}"
                    }
                }
            })
        })
    })
</script>
@endpush