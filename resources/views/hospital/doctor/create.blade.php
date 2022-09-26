@extends("layouts.hospital.app")

@section("title", "Hospital Doctor Create Profile")

@section("content")

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-heading text-end">
                <div class="card-title">
                    <a href="{{route('hospital.doctor.index')}}" class="btn btn-danger px-3">Back To Home</a>
                </div>
            </div>
            <div class="card-body">
                <form id="saveDoctor">
                    <div class="personal-info px-3">
                        <h5>Personal Information</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Name <small class="text-danger">*</small></label>
                                    <input type="text" name="name" class="form-control" placeholder="Ex: Dr. Rayhan">
                                    <span class="error-name error text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="username">Username<small class="text-danger">*</small></label>
                                    <input type="text" name="username" class="form-control" placeholder="Ex: username">
                                    <span class="error-username error text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email">
                                <span class="error-email error text-danger"></span>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">Password<small class="text-danger">*</small></label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                    <span class="error-password error text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="phone">Phone<small class="text-danger">*</small></label>
                                <div class="input-group">
                                    <i class="btn btn-secondary">+88</i><input type="text" id="phone" name="phone" class="form-control" placeholder="Ex: 01737 484046">
                                </div>
                                <span class="error-phone error text-danger"></span>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="department_id">Specialist<small class="text-danger">*</small></label>
                                    <select name="department_id" id="department_id" class="form-control select2">
                                        <option value="">Choose a speciality</option>
                                        @foreach($departments as $department)
                                        <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="error-deparment_id error text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="education">Education<small class="text-danger">*</small></label>
                                    <input type="text" name="education" class="form-control" placeholder="Ex: MPH In Public Health Nutrition (NUB)">
                                    <span class="error-education error text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="first_fee">First Fee<small class="text-danger">*</small></label>
                                <div class="input-group">
                                    <input type="number" id="first_fee" name="first_fee" class="form-control" placeholder="Ex: 800 Tk"><i class="btn btn-secondary">Tk</i>
                                </div>
                                <span class="error-first_fee error text-danger"></span>
                            </div>
                            <div class="col-md-3">
                                <label for="second_fee">Second Fee<small class="text-danger">*</small></label>
                                <div class="input-group">
                                    <input type="number" id="second_fee" name="second_fee" class="form-control" placeholder="Ex: 800 Tk"><i class="btn btn-secondary">Tk</i>
                                </div>
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
                                        <input type="checkbox" id="sat" name="availability[]" value="sat" /><label>Saturday</label>
                                        <input type="checkbox" id="sun" name="availability[]" value="sun" /><label>Sunday</label>
                                        <input type="checkbox" id="mon" name="availability[]" value="mon" /><label>Monday</label>
                                        <input type="checkbox" id="tue" name="availability[]" value="tue" /><label>Tuesday</label><br>
                                        <input type="checkbox" id="wed" name="availability[]" value="wed" /><label>Wednessday</label>
                                        <input type="checkbox" id="thu" name="availability[]" value="thu" /><label>Thursday</label>
                                        <input type="checkbox" id="fri" name="availability[]" value="fri" /><label>Friday</label>
                                    </div>
                                    <span class="error-availability error text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="from">From<small class="text-danger">*</small></label>
                                <input type="time" id="from" name="from" class="form-control">
                                <span class="error-from error text-danger"></span>
                            </div>
                            <div class="col-md-2">
                                <label for="to">To<small class="text-danger">*</small></label>
                                <input type="time" id="to" name="to" class="form-control">
                                <span class="error-to error text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="px-3 mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="image">Doctor Image</label>
                                    <input type="file" class="form-control" id="image" name="image" onchange="document.querySelector('.img').src = window.URL.createObjectURL(this.files[0])">
                                    <span class="error-image error text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="image">
                                    <img width="100" class="img" height="100">
                                </div>
                            </div>
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
        $("#saveDoctor").on("submit", (event) => {
            event.preventDefault()
            var formdata = new FormData(event.target)
            $.ajax({
                url: "{{route('hospital.doctor.store')}}",
                data: formdata,
                method: "POST",
                dataType: "JSON",
                contentType: false,
                processData: false,
                beforeSend: () => {
                    $("#saveDoctor").find(".error").text("");
                },
                success: (response) => {
                    if (response.error) {
                        $.each(response.error, (index, value) => {
                            $("#saveDoctor").find(".error-" + index).text(value);
                        })
                    } else {
                        $("#saveDoctor").trigger('reset')
                        $.notify(response, "success");
                    }
                }
            })
        })
    })
</script>
@endpush