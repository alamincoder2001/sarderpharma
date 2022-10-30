@extends("layouts.app")

@section("title", "Doctor Profile")

@push("style")
<style>
    .select2-container .select2-selection--single {
        height: 33px !important;
    }
</style>
@endpush

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
                                <label for="username">Username<small class="text-danger">*</small></label>
                                <input type="text" id="username" name="username" class="form-control" placeholder="Ex: username">
                                <span class="error-username text-danger"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email">
                                <span class="error-email text-danger"></span>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">Password<small class="text-danger">*</small></label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                    <span class="error-password text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="phone">Phone<small class="text-danger">*</small></label>
                                <div class="input-group">
                                    <i class="btn btn-secondary">+88</i><input type="text" id="phone" name="phone" class="form-control" placeholder="01737 484046">
                                </div>
                                <span class="error-phone error text-danger"></span>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="education">Education<small class="text-danger">*</small></label>
                                    <input type="text" name="education" class="form-control" placeholder="Ex: MPH In Public Health Nutrition (NUB)">
                                    <span class="error-education error text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="department_id">Specialist<small class="text-danger">*</small></label>
                                    <div class="input-group">
                                        <select name="department_id" id="department_id" class="form-control select2">
                                            <option value="">Choose a speciality</option>
                                            @foreach($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                        <i class="btn btn-secondary addDepartment">+</i>
                                    </div>
                                    <span class="error-department_id error text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city_id">City Name<small class="text-danger">*</small></label>
                                    <select name="city_id" id="city_id" class="form-control select2">
                                        <option value="">Choose a city name</option>
                                        @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="error-city_id text-danger error"></span>
                            </div>
                            <div class="col-md-2">
                                <label for="first_fee">First Fee<small class="text-danger">*</small></label>
                                <input type="number" id="first_fee" name="first_fee" class="form-control" placeholder="Ex: 800 Tk">
                                <span class="error-first_fee error text-danger"></span>
                            </div>
                            <div class="col-md-2">
                                <label for="second_fee">Second Fee<small class="text-danger">*</small></label>
                                <input type="number" id="second_fee" name="second_fee" class="form-control" placeholder="Ex: 800 Tk">
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
                            <div id="chamber" class="col-md-8 row d-none">
                                <div class="col-md-12">
                                    <table class="table chamberTable">
                                        <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Chamber Name</th>
                                                <th>Address</th>
                                                <th><i class="btn btn-dark ChamberName">+</i></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="hospital" class="col-md-8 row d-none">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hospital_id">Hospital Name</label>
                                        <select multiple name="hospital_id[]" id="hospital_id" class="select1 form-control">
                                            @foreach($hospitals as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="error-hospital_id error text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div id="diagnostic" class="col-md-8 d-none row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="diagnostic_id">Diagnostic Name</label>
                                        <select multiple name="diagnostic_id[]" id="diagnostic_id" class="select1 form-control">
                                            @foreach($diagnostics as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
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
                                    <img width="100" class="img" height="100">
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
                        <button type="submit" class="btn btn-success text-white text-uppercase px-3">Save</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Add Speciality</h5>
            </div>
            <form id="formDepartment">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Speciality</label>
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

        $(document).on("change", ".changeModule", (event) => {
            if (event.target.value == "chamber") {
                $("#chamber").removeClass("d-none")
                $("#hospital").addClass("d-none")
                $("#diagnostic").addClass("d-none")
                $('.select1').select2();
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
                $('.select1').select2();
            }
        })

        $(".ChamberName").on("click", (event) => {
            var count = $(".chamberTable").find("tbody").html();
            if (count != "") {
                var totallength = $(".chamberTable").find("tbody tr").length;
                var row = `
                <tr class="${totallength+1}">
                    <td>${totallength+1}</td>
                    <td><input type="text" name="chamber[]" class="form-control" placeholder="Chamber Name"/></td>
                    <td><input type="text" name="address[]" class="form-control" placeholder="Chamber Address"/></td>
                    <td><span data="${totallength+1}"  class="text-danger removeChamber" style="cursor:pointer;">Remove</span></td>
                </tr>
            `;

                $(".chamberTable").find("tbody").prepend(row)
            } else {
                var row = `
                <tr class="1">
                    <td>1</td>
                    <td><input type="text" name="chamber[]" class="form-control Chamber-Name" placeholder="Chamber Name"/></td>
                    <td><input type="text" name="address[]" class="form-control Chamber-Address" placeholder="Chamber Address"/></td>
                    <td><span data="1"  class="text-danger removeChamber" style="cursor:pointer;">Remove</span></td>
                </tr>
            `;

                $(".chamberTable").find("tbody").prepend(row)
            }
        })

        $(document).on("click", ".removeChamber", event => {
            $(".chamberTable").find("tbody ."+event.target.attributes[0].value).remove()
        })

        $("#saveDoctor").on("submit", (event) => {
            event.preventDefault()
            var formdata = new FormData(event.target)
            $.ajax({
                url: "{{route('admin.doctor.store')}}",
                data: formdata,
                method: "POST",
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
                        $(".img").attr("src", "");
                        $.notify(response, "success")
                        $('.select1').select2();
                        $("#chamber").addClass("d-none")
                        $("#hospital").addClass("d-none")
                        $("#diagnostic").addClass("d-none")
                    }
                }
            })
        })
    })

    $(".addDepartment").on("click", event => {
        $("#myModal").modal('show');
    })

    $(document).on("submit", "#formDepartment", event => {
        event.preventDefault()
        var name = $("#formDepartment").find("#name").val()
        var formdata = new FormData(event.target)
        $.ajax({
            url: "{{route('department.store')}}",
            data: formdata,
            method: "POST",
            contentType: false,
            processData: false,
            beforeSend: () => {
                $("#formDepartment").find(".error").text("");
            },
            success: (response) => {
                if (response.error) {
                    $.each(response.error, (index, value) => {
                        $("#addDepartment").find(".error-" + index).text(value);
                    })
                } else {
                    $("#addDepartment").trigger('reset')
                    $.notify(response.msg, "success")
                    $("#myModal").modal('hide');
                    $("#department_id").append(`<option value="${response.id}">${name}</option>`);
                    $('.select2').select2();
                }
            }
        })
    })
</script>
@endpush