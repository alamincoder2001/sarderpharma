@extends("layouts.diagnostic.app")

@section("title", "Diagnostic Doctor Edit Profile")

@section("content")

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-heading text-end">
                <div class="card-title">
                    <a href="{{route('diagnostic.doctor.index')}}" class="btn btn-danger px-3">Back To Home</a>
                </div>
            </div>
            <div class="card-body">
                <form id="updateDoctor">
                    <input type="hidden" id="id" name="id" value="{{$data->id}}">
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
                                <div class="form-group">
                                    <label for="username">Username <small class="text-danger">*</small></label>
                                    <input type="text" name="username" class="form-control" value="{{$data->username}}">
                                    <span class="error-username error text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{$data->email}}">
                                <span class="error-email error  text-danger"></span>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">Password<small class="text-danger">*</small></label>
                                    <div class="input-group">
                                        <input type="checkbox" id="Showpassword">
                                        <input type="password" name="password" id="password" class="form-control" disabled>
                                    </div>
                                    <span class="error-password text-danger error"></span>
                                </div>
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
                                    @php
                                    $specialist = App\Models\Specialist::where("doctor_id", $data->id)->pluck("department_id")->toArray();
                                    @endphp

                                    <label for="department_id">Specialist<small class="text-danger">*</small></label>
                                    <div class="input-group">
                                        <select multiple name="department_id[]" id="department_id" class="form-control select2">
                                            @foreach($departments as $department)
                                            <option value="{{$department->id}}" {{in_array($department->id, $specialist)?"selected":""}}>{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                        <i class="btn btn-secondary addDepartment">+</i>
                                    </div>
                                    <span class="error-department_id error text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="first_fee">First Fee<small class="text-danger">*</small></label>
                                <div class="input-group">
                                    <input type="number" id="first_fee" name="first_fee" class="form-control" value="{{$data->first_fee}}"><i class="btn btn-secondary">Tk</i>
                                </div>
                                <span class="error-first_fee error text-danger"></span>
                            </div>
                            <div class="col-md-2">
                                <label for="second_fee">Second Fee<small class="text-danger">*</small></label>
                                <div class="input-group">
                                    <input type="number" id="second_fee" name="second_fee" class="form-control" value="{{$data->second_fee}}"><i class="btn btn-secondary">Tk</i>
                                </div>
                                <span class="error-second_fee error text-danger"></span>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="availability">Availability Day <small class="text-danger">*</small></label>
                                    <div class="input-group gap-2">
                                        <input type="checkbox" {{in_array("sat",$avail,true)?"checked":''}} id="sat" name="availability[]" value="sat" /><label>Saturday</label>
                                        <input type="checkbox" {{in_array("sun",$avail,true)?"checked":''}} id="sun" name="availability[]" value="sun" /><label>Sunday</label>
                                        <input type="checkbox" {{in_array("mon",$avail,true)?"checked":''}} id="mon" name="availability[]" value="mon" /><label>Monday</label>
                                        <input type="checkbox" {{in_array("tue",$avail,true)?"checked":''}} id="tue" name="availability[]" value="tue" /><label>Tuesday</label>
                                        <input type="checkbox" {{in_array("wed",$avail,true)?"checked":''}} id="wed" name="availability[]" value="wed" /><label>Wednessday</label>
                                        <input type="checkbox" {{in_array("thu",$avail,true)?"checked":''}} id="thu" name="availability[]" value="thu" /><label>Thursday</label>
                                        <input type="checkbox" {{in_array("fri",$avail,true)?"checked":''}} id="fri" name="availability[]" value="fri" /><label>Friday</label>
                                    </div>
                                    <span class="error-availability error text-danger"></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="">Time <i class="fa fa-plus" onclick="TimeAdd()"></i></label>
                                <div class="timeadd">
                                    @foreach($data->time as $item)
                                    <div class="input-group">
                                        <input type="time" id="from" name="from[]" class="form-control" value="{{$item->from}}">
                                        <input type="time" id="to" name="to[]" class="form-control" value="{{$item->to}}">
                                        <button type="button" class="btn btn-danger removeTime">remove</button>
                                    </div>
                                    @endforeach
                                </div>
                                <span class="error-time error text-danger"></span>
                            </div>
                            <div class="col-6">
                                <label for="phone">Phone <i class="fa fa-plus" onclick="phoneAdd()"></i></label>
                                <div class="phoneadd">
                                    @php
                                    $phone = explode(",", $data->phone);
                                    @endphp
                                    @foreach($phone as $item)
                                    <div class="input-group">
                                        <input type="text" id="phone" name="phone[]" class="form-control" value="{{$item}}">
                                        <button type="button" class="btn btn-danger removePhone">remove</button>
                                    </div>
                                    @endforeach
                                </div>
                                <span class="error-phone error text-danger"></span>
                            </div>
                            <div class="col-12">
                                <label for="concentration">Consultancy</label>
                                <textarea name="concentration" id="concentration">{!! $data->concentration !!}</textarea>
                            </div>
                            <div class="col-12">
                                <label for="description">Description</label>
                                <textarea name="description" id="description">{!! $data->description !!}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center mx-1 mt-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="image">Doctor Image</label>
                                <input type="file" class="form-control" id="image" name="image" onchange="document.querySelector('.img').src = window.URL.createObjectURL(this.files[0])">
                                <span class="error-image error text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="image">
                                <img src="{{asset($data->image)}}" width="100" class="img" height="100">
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center mt-3">
                        <button type="submit" class="btn btn-info text-white text-uppercase px-3">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push("js")
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
    CKEDITOR.replace('concentration');
    $(".select2").select2()
    $(document).ready(() => {
        $("#Showpassword").on("click", (event) => {
            if (event.target.checked) {
                $("#password").attr("disabled", false)
            } else {
                $("#password").attr("disabled", true)
            }
        })
        $("#updateDoctor").on("submit", (event) => {
            event.preventDefault()
            var description = CKEDITOR.instances.description.getData();
            var concentration = CKEDITOR.instances.concentration.getData();

            var formdata = new FormData(event.target)
            formdata.append("description", description)
            formdata.append("concentration", concentration)

            $.ajax({
                url: "{{route('diagnostic.doctor.update')}}",
                data: formdata,
                method: "POST",
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
                        $("#updateDoctor").trigger('reset')
                        $.notify(response, "success");
                        window.location.href = "{{route('diagnostic.doctor.index')}}"
                    }
                }
            })
        })
    })

    function TimeAdd() {
        var row = `
            <div class="input-group">
                <input type="time" id="from" name="from[]" class="form-control">
                <input type="time" id="to" name="to[]" class="form-control">
                <button type="button" class="btn btn-danger removeTime">remove</button>
            </div>
        `
        $(".timeadd").append(row)
    }

    function phoneAdd() {
        var row = `
            <div class="input-group">
                <input type="text" id="phone" name="phone[]" class="form-control">
                <button type="button" class="btn btn-danger removePhone">remove</button>
            </div>
        `
        $(".phoneadd").append(row)
    }

    $(document).on("click", ".removeTime", event => {
        event.target.offsetParent.remove();
    })

    $(document).on("click", ".removePhone", event => {
        event.target.offsetParent.remove();
    })
</script>
@endpush