@extends("layouts.master")

@push('style')

<style>
    #appointment input[type="text"] {
        padding: 7px 8px;
        font-size: 13px;
        width: 100%;
        outline: none;
        border: 0;
        border-bottom: 1px solid #b7b7b7;
        font-family: cursive;
    }

    #appointment input[type="text"]:focus {
        box-shadow: none;
        border-color: green;
    }

    #appointment select {
        padding: 7px 8px;
        font-size: 14px;
        width: 100%;
        outline: none;
        border: 0;
        border-bottom: 1px solid #b7b7b7;
        cursor: pointer;
        font-family: cursive;
    }

    #appointment select:focus {
        box-shadow: none;
        border-color: green;
    }

    #appointment textarea {
        padding: 7px 8px;
        font-size: 14px;
        width: 100%;
        outline: none;
        border: 0;
        border-bottom: 1px solid #b7b7b7;
        font-family: cursive;
    }

    #appointment textarea:focus {
        box-shadow: none;
        border-color: green;
    }

    #appointment input[type="number"] {
        padding: 7px 8px;
        font-size: 14px;
        width: 100%;
        outline: none;
        border: 0;
        border-bottom: 1px solid #b7b7b7;
        font-family: cursive;
    }

    #appointment input[type="number"]:focus {
        box-shadow: none;
        border-color: green;
    }

    #appointment button {
        text-transform: uppercase;
        font-size: 13px;
        font-weight: 600;
        font-family: cursive;
        box-shadow: none;
    }

    #appointment label {
        font-family: cursive;
        font-size: 14px;
    }

    /* select2 style */
    .select2-container--default .select2-selection--single {
        border: none !important;
        border-bottom: 1px solid #b7b7b7 !important;
        border-radius: 0.3rem !important;
    }

    .select2-container .select2-selection--single {
        height: 35px !important;
    }

    .select2-search--dropdown {
        padding: 0 !important;
    }

    .select2-container--default .select2-search--dropdown .select2-search__field:focus-visible {
        border: none !important;
    }

    .select2-results {
        color: #858585;
        font-family: cursive;
        font-size: 14px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 34px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: #858585;
        font-family: cursive;
        font-size: 14px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #9b9b9b !important;
        line-height: 29px !important;
        padding-left: 10px !important;
    }

    .goog-te-menu-value span {
        display: none;
        margin: 6px !important;
    }
</style>

@section("content")
<section id="appointment" style="padding: 55px 0;">
    <div class="container">
        <div class="doctordetail-header rounded" style="background: #fff; border:2px solid #1b6c93ba !important;">
            <div class="row">
                <div class="col-md-3 text-center">
                    <img src="{{asset($data->image?$data->image:'frontend/nodoctorimage.png')}}" width="150" style="max-height: 170px;" class="rounded border border-1 p-2" alt="">
                </div>
                <div class="col-md-4 d-flex align-items-center text-center justify-content-md-start justify-content-center">
                    <div class="d-flex align-items-center" style="flex-direction:column;">
                        <h4>{{$data->name}}</h4>
                        <h5 style="font-size: 14px;font-weight: 300;">{{$data->education}}</h5>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="border-start p-2">
                        <h6>
                            @foreach($data->department as $dept)
                            {{$dept->specialist->name}},
                            @endforeach
                        </h6>
                        <p>
                            <span class="fs-5" style="font-size: 15px !important;font-weight: 500;">Address:</span>
                            @if($data->chamber_name)
                            {{$data->address}}, {{$data->city->name}}
                            @else
                            @if($data->hospital_id || $data->diagnostic_id)
                            {{$data->hospital_id?$data->hospital->address:$data->diagnostic->address}}, {{$data->hospital_id?$data->hospital->city->name:$data->diagnostic->city->name}}
                            @endif
                            @endif
                        </p>
                        <p class="d-flex">
                            <span class="fs-5" style="font-size: 15px !important;font-weight: 500;">Available Date & Time:</span>
                        <ul style="padding:0; margin:0; display: flex;list-style:none;gap:5px;">
                            @foreach(explode(",", $data->availability) as $availity)
                            <li style="font-size: 12px;">{{ucwords($availity)}}</li>
                            @endforeach
                        </ul>
                        </p>
                        @foreach($data->time as $t)
                        <small>{{date("h:i a",strtotime($t->from))}}- {{date("h:i a",strtotime($t->to))}}, </small>
                        @endforeach
                        <br />
                        <small>Contact: +88 {{$data->phone}}</small>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="card p-3" style="background:#f5f5f5;box-shadow:1px 1px 1px 2px #1b6c93ba;">
                    <div class="card-header border-0 text-white" style="background: #035b64 !important;">
                        <h4 class="fs-6 text-uppercase">Appointment</h4>
                    </div>
                    <div class="card-body">
                        <form id="Appointment">
                            <input type="hidden" id="doctor_id" name="doctor_id" value="{{$data->id}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact" class="py-2">Contact</label>
                                        <input type="text" name="contact" id="contact" autocomplete="off" class="form-control" placeholder="Contact Number">
                                        <span class="error-contact error text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="py-2">Email</label>
                                        <input type="text" name="email" id="email" class="form-control" autocomplete="off" placeholder="example@gmail.com">
                                    </div>
                                </div>
                                <div class="col-md-7 col-6">
                                    <div class="form-group">
                                        <label for="changeName" class="py-2">Select Chamber or Hospital or Diagnostic</label>
                                        <select id="changeName" data-id="{{$data->id}}" name="changeName" class="form-control">
                                            <option value="">Select Name</option>
                                            <option value="chamber">Chamber</option>
                                            <option value="hospital">Hospital</option>
                                            <option value="diagnostic">Diagnostic</option>
                                        </select>
                                        <span class="error-changeName error text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-5 d-none Chamber_Name">
                                    <label for="chamber_name" class="py-2">Select Chamber Name</label>
                                    <select id="chamber_name" disabled name="chamber_name" class="form-control">
                                        <option value="">Select Chamber</option>
                                    </select>
                                    <span class="chamber_id text-danger"></span>
                                </div>
                                <div class="col-md-5 d-none Hospital_Name">
                                    <label for="hospital_id" class="py-2">Select Hospital Name</label>
                                    <select id="hospital_id" disabled name="hospital_id" class="form-control">
                                        <option value="">Select Hospital</option>
                                    </select>
                                    <span class="hospital_id text-danger"></span>
                                </div>
                                <div class="col-md-5 d-none Diagnostic_Name">
                                    <label for="diagnostic_id" class="py-2">Select Diagnostic Name</label>
                                    <select id="diagnostic_id" disabled name="diagnostic_id" class="form-control">
                                        <option value="">Select Diagnostic</option>
                                    </select>
                                    <span class="diagnostic_id text-danger"></span>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <label for="appointment_date" class="py-2">Appointment Date</label>
                                        <input type="text" name="appointment_date" id="appointment_date" class="form-control" value="{{date('d-m-Y')}}">
                                        <span class="error-appointment_date error text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <label for="problem" class="py-2">Problem</label>
                                        <textarea name="problem" class="form-control" id="problem" placeholder="Decribe your problem"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="py-2">Patient Name</label>
                                        <input type="text" name="name" id="name" class="form-control" autocomplete="off" placeholder="Patient Name">
                                        <span class="error-name error text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="age" class="py-2">Patient Age</label>
                                        <input type="number" name="age" id="age" class="form-control" placeholder="Age">
                                        <span class="error-age error text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="district" class="py-2">Ditrict</label>
                                        <select name="district" id="district" class="form-control select2">
                                            <option value="">Select District</option>
                                        </select>
                                        <span class="error-district error text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="upozila" class="py-2">Upazila</label>
                                        <select name="upozila" id="upozila" class="form-control" style="color:#8f8a8a">
                                            <option value="">Select Upazila</option>
                                        </select>
                                        <span class="error-upozila error text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-secondary mt-4">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card" style="box-shadow: 1px 1px 1px 2px #1b6c93ba; height:552px">
                    <div class="card-body">
                        <div class="card-header border-0 text-white" style="background: #035b64 !important;">
                            <h4 class="fs-6 text-uppercase">Info</h4>
                        </div>
                        <div class="card-body">
                            <h6>Consultant. Department of
                                @foreach($data->department as $dept)
                                {{$dept->specialist->name}},
                                @endforeach
                            </h6>
                            <h5 style="font-size:14px;">
                                @if(count($data->chamber) != 0)
                                @foreach($data->chamber->take(1) as $chamber)
                                 <i class="fa fa-home"></i> {{$chamber->name}}
                                @endforeach
                                @endif
                                <br>
                                <i class="fa fa-hospital-o"></i> {{$data->hospital_id?$data->hospital->name:""}}
                                <br>
                                <i class="fa fa-plus-square-o"></i> {{$data->diagnostic_id?$data->diagnostic->name:""}}
                            </h5>
                            <div class="clearfix mb-2" style="border-bottom:1px solid #ddd"></div>
                            <div class="details-status">
                                <div style="text-align: justify;" id="description">{!!$data->description!!}</div>
                            </div>
                            <div class="clearfix my-2" style="border-bottom:1px solid #ddd"></div>
                            <div class="concentration">
                                <h6>Field of Concentration:</h6>
                                <div style="font-size: 13px;" id="concentration">{!!$data->concentration!!}</div>
                            </div>
                            <div class="clearfix my-2" style="border-bottom:1px solid #ddd"></div>
                            <div class="consultancy">
                                <h6>Consultancy Fee:</h6>
                                <p><span>New Visit:</span> {{$data->first_fee}} Tk</p>
                                <p><span>Second Visit:</span> {{$data->second_fee}} Tk</p>
                                <p><span>Report Show:</span> Published soon</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

@push("js")
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(() => {
        $("#appointment_date").datepicker({
            format: "dd-mm-yyyy",
            startDate: new Date(),
            orientation: 'bottom'
        })

        $(".select2").select2({
            placeholder: "Select City"
        })

        function gethosdig(id, name, selector) {
            $.ajax({
                url: "{{route('filter.singlehospitaldiagnostic')}}",
                method: "POST",
                data: {
                    id: id,
                    name: name
                },
                beforeSend: () => {
                    $("#chamber_name").html(`<option value="">Select Chamber</option>`)
                    $("#diagnostic_id").html(`<option value="">Select Diagnostic</option>`)
                    $("#hospital_id").html(`<option value="">Select Hospital</option>`)
                },
                success: (response) => {
                    if (response.null) {} else {
                        $.each(response, (index, value) => {
                            if (value.null == 0) {
                                $(selector).append(`<option value="${value.id}">${value.name}</option>`)
                            } else {
                                $(selector).append(`<option value="${value.id}">${value.name}</option>`)
                            }
                        })
                    }
                }
            })
        }
        $("#changeName").on("change", (event) => {
            if (event.target.value == "chamber") {
                $(".Chamber_Name").removeClass("d-none");
                $(".Hospital_Name").addClass("d-none");
                $(".Diagnostic_Name").addClass("d-none");
                $("#chamber_name").attr("disabled", false);
                $("#diagnostic_id").attr("disabled", true);
                $("#hospital_id").attr("disabled", true);
                var id = $("#changeName").attr("data-id");
                gethosdig(id, event.target.value, "#chamber_name")
            } else if (event.target.value == "hospital") {
                $(".Chamber_Name").addClass("d-none");
                $(".Hospital_Name").removeClass("d-none");
                $(".Diagnostic_Name").addClass("d-none");
                $("#chamber_name").attr("disabled", true);
                $("#diagnostic_id").attr("disabled", true);
                $("#hospital_id").attr("disabled", false);
                var id = $("#changeName").attr("data-id");
                gethosdig(id, event.target.value, "#hospital_id")
            } else if (event.target.value == "diagnostic") {
                $(".Chamber_Name").addClass("d-none");
                $(".Hospital_Name").addClass("d-none");
                $(".Diagnostic_Name").removeClass("d-none");
                $("#chamber_name").attr("disabled", true);
                $("#diagnostic_id").attr("disabled", false);
                $("#hospital_id").attr("disabled", true);
                var id = $("#changeName").attr("data-id");
                gethosdig(id, event.target.value, "#diagnostic_id")
            } else {
                $(".Chamber_Name").addClass("d-none");
                $(".Hospital_Name").addClass("d-none");
                $(".Diagnostic_Name").addClass("d-none");
                $("#chamber_name").attr("disabled", true);
                $("#diagnostic_id").attr("disabled", true);
                $("#hospital_id").attr("disabled", true);
            }
        })
        // get city
        $("#district").on("change", (event) => {
            if (event.target.value) {
                $.ajax({
                    url: "{{route('filter.cityappoinment')}}",
                    method: "POST",
                    data: {
                        id: event.target.value
                    },
                    beforeSend: () => {
                        $("#upozila").html(`<option value="">Select Upozila</option>`)
                    },
                    success: (response) => {
                        if (response.null) {} else {
                            $.each(response, (index, value) => {
                                $("#upozila").append(`<option value="${value.id}">${value.name}</option>`)
                            })
                        }
                    }
                })
            }
        })

        // appointment send
        $("#Appointment").on("submit", (event) => {
            event.preventDefault();

            var contact = $("#Appointment").find("#contact").val()
            if (!Number(contact)) {
                $("#Appointment").find(".error-contact").text("Must be a number value")
                return;
            }
            var changeName = $("#Appointment").find("#changeName").val()
            var formdata = new FormData(event.target)
            $.ajax({
                url: "{{route('appointment')}}",
                data: formdata,
                method: "POST",
                contentType: false,
                processData: false,
                beforeSend: () => {
                    $("#Appointment").find(".error").text("");
                    $("#Appointment").find(".chamber_id").text("");
                    $("#Appointment").find(".hospital_id").text("");
                    $("#Appointment").find(".diagnostic_id").text("");
                },
                success: (response) => {
                    if (response.error) {
                        $.each(response.error, (index, value) => {
                            $("#Appointment").find(".error-" + index).text(value);
                        })
                    } else if (response.errors) {
                        if (changeName === "chamber") {
                            $("#Appointment").find(".chamber_id").text("Select Chamber Name")
                        } else if (changeName === "hospital") {
                            $("#Appointment").find(".hospital_id").text("Select Hospital Name")
                        } else {
                            $("#Appointment").find(".diagnostic_id").text("Select Diagnostic Name")
                        }
                    } else {
                        $("#Appointment").trigger('reset')
                        $.notify(response, "success");
                        Swal.fire(
                            'Thanks your Appointment!',
                            'কিছুক্ষণের মধ্যে আমাদের একজন প্রতিনিধী আপনার সাথে যোগাযোগ করবে।',
                            'success'
                        )
                        $(".Chamber_Name").addClass("d-none");
                        $(".Hospital_Name").addClass("d-none");
                        $(".Diagnostic_Name").addClass("d-none");
                        $("#chamber_name").attr("disabled", true);
                        $("#diagnostic_id").attr("disabled", true);
                        $("#hospital_id").attr("disabled", true);
                    }
                }
            })
        })
        getCity();
        // old patient get details by phone
        $("#contact").on("input", (event) => {
            var phoneno = "(?:\\+88|88)?(01[3-9]\\d{8})";
            if (event.target.value) {
                if (event.target.value.match(phoneno)) {
                    $("#Appointment").find(".error-contact").text("")
                    $("#Appointment").find("#contact").css({
                        borderBottom: "1px solid #b7b7b7"
                    })
                    $.ajax({
                        url: "{{route('get.patient.details')}}",
                        method: "POST",
                        data: {
                            number: event.target.value
                        },
                        beforeSend: () => {
                            $("#email").val("")
                            $("#name").val("")
                            $("#age").val("")
                            $("#upozila").html("")
                            getCity();
                        },
                        success: (response) => {
                            if (response) {
                                $("#email").val(response.email)
                                $("#name").val(response.name)
                                $("#age").val(response.age)
                                $("#upozila").html(`<option value="${response.upozila}">${response.upazila.name}</option>`)
                                $("#district").html(`<option value="${response.district}">${response.city.name}</option>`)
                            }
                        }
                    })
                } else {
                    $("#Appointment").find("#contact").css({
                        borderBottom: "1px solid red"
                    })
                    $("#Appointment").find(".error-contact").text("Not valid Number")
                }
            } else {
                $("#Appointment").find(".error-contact").text("")
                $("#Appointment").find("#contact").css({
                    borderBottom: "1px solid #b7b7b7"
                })
                $("#email").val("")
                $("#name").val("")
                $("#age").val("")
                $("#upozila").html("")
                $("#district").html("")
                getCity();
                $(".select2").select2({
                    placeholder: "Select City"
                })
            }
        })
    })
    
    var concentration = document.getElementById("concentration");
    concentration.setAttribute('data-full', concentration.innerHTML);
    if (concentration.innerText.length > 50) {
        concentration.innerHTML = `${concentration.innerHTML.slice(0, 300)}...`;

        const btn = document.createElement('button');
        btn.innerText = 'Read more...';
        btn.style.border = "none"
        btn.style.float = "right"
        btn.style.background = "none"
        btn.setAttribute('onclick', 'displayConcentration(event)');
        concentration.appendChild(btn);
    }
    const displayConcentration = (elem) => {
        concentration.innerHTML = concentration.getAttribute('data-full');
        concentration.style.height = "200px"
        concentration.style.overflow = "scroll"
        elem.target.remove();
    };
    // description
    var description = document.getElementById("description");
    description.setAttribute('data-full', description.innerHTML);
    if (description.innerText.length > 50) {
        description.innerHTML = `${description.innerHTML.slice(0, 300)}...`;

        const btn = document.createElement('button');
        btn.innerText = 'Read more...';
        btn.style.border = "none"
        btn.style.float = "right"
        btn.style.background = "none"
        btn.setAttribute('onclick', 'displayDescription(event)');
        description.appendChild(btn);
    }
    const displayDescription = (elem) => {
        description.innerHTML = description.getAttribute('data-full');
        description.style.height = "150px"
        description.style.overflow = "scroll"
        elem.target.remove();
    };
</script>
@endpush