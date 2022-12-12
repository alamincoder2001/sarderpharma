@extends("layouts.master")
@push("js")
<style>
    /* =========== select doctor ============ */
    .select2-container--default .select2-selection--single {
        border: 0 !important;
        border-radius: 0;
    }

    .select2-container .select2-selection--single {
        height: 32px !important;
        background: black !important;
        border-radius: 5rem !important;
    }

    .select2-container {
        width: -webkit-fill-available !important;
    }

    .select2-search--dropdown {
        padding: 0 !important;
        background: black;
    }

    .select2-container--default .select2-search--dropdown .select2-search__field:focus-visible {
        border: none !important;
    }

    .select2-results {
        background: black;
        color: white;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #9b9b9b !important;
        line-height: 29px !important;
        padding-left: 20px !important;
    }


    /* =========== doctor card design ============ */
    .doctor_details .card {
        transition: 2ms ease-in-out;
    }

    .doctor_details .card:hover {
        border: 1px solid #d9d9d9 !important;
        box-shadow: 5px 3px 0px 3px #81818130 !important;
    }

    .doctor_department {
        text-decoration: none;
        display: block;
        list-style: none;
        padding: 4px;
        font-family: auto;
        margin-bottom: 5px;
        border-bottom: 1px dashed #d1d1d1;
        color: #626262;
        transition: 2ms ease-in-out;
    }

    .doctor_department:hover {
        color: red !important;
    }
</style>
@endpush
@section("content")
<section id="doctor-details">
    <div class="container">
        <div class="doctordetail-header">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-10 col-10">
                    <form id="filterDoctor" class="form">
                        <div class="row justify-content-center d-flex">
                            <div class="col-md-4 col-10">
                                <div class="form-group mb-4 mb-md-0">
                                    <label for="city" class="d-md-block d-none">City</label>
                                    <select class="rounded-pill city" name="city" id="city">
                                        <option value="">Select City</option>
                                        @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="error-city error text-white"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-10">
                                <div class="form-group d-none doctor-select">
                                    <label for="doctor_select" class="d-md-block d-none">Doctor Name</label>
                                    <select class="rounded-pill doctor_select" id="doctor_select">
                                        <option value="">Select Doctor Name</option>
                                    </select>
                                    <span class="error-doctor_select error text-white"></span>
                                </div>
                                <div class="form-group doctor_name">
                                    <label for="doctor_name" class="d-md-block d-none">Doctor Name</label>
                                    <input type="text" name="doctor_name" id="doctor_name" class="form-control" style="height: 33px;border-radius: 2rem;background: black;border: 0;box-shadow: none;color: #a3a3a3;padding-left: 18px;padding-top: 3px;">
                                    <span class="error-doctor_name error text-white"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="form-group text-center">
                                    <label for="country"></label>
                                    <button class="btn text-white rounded-pill">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row m-lg-0" style="border: 1px solid #e5e5e5;">
            <div class="col-12 col-lg-3 p-lg-0">
                <div class="card" style="border-radius: 0;height:100%;">
                    <div class="card-header" style="border: none;border-radius: 0;background: #e3e3e3;">
                        <h6 class="card-title text-uppercase" style="color:#832a00;">Department List</h6>
                    </div>
                    <div class="card-body">
                        @foreach($departments as $item)
                        <a href="{{route('doctor.details',strtolower($item->name))}}" class="doctor_department">{{mb_strimwidth($item->name, 0, 35, "...")}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-9 doctor_details">
                <div class="Loading text-center d-none">
                    <img src="{{asset('loading.gif')}}" width="350px">
                </div>
                <div class="row py-2 doctorbody">
                    @foreach($data['specialist'] as $item)
                    <div class="col-12 col-lg-6 mb-3">
                        <a href="{{route('singlepagedoctor', $item->doctor->id)}}" target="_blank" class="text-decoration-none text-secondary" title="{{$item->doctor->name}}">
                            <div class="card" style="border-radius: 0;border: 0;font-family: auto;box-shadow: 0px 0px 8px 0px #bfbfbfbf;height:130px;">
                                <div class="card-body d-flex" style="padding: 5px;gap: 8px;">
                                    <div class="image" style="border: 1px dotted #ababab;height: 110px;margin-top: 4px;">
                                        <img src="{{asset($item->doctor->image? $item->doctor->image:'/uploads/nouserimage.png')}}" width="100" height="100%">
                                    </div>
                                    <div class="info" style="padding-right:5px;">
                                        <h6>{{$item->doctor->name}}</h6>
                                        <p style="color:#c99913;">{{$item->specialist->name}}, {{$item->doctor->city->name}}</p>
                                        <p style="border-top: 2px dashed #dddddd85;text-align:justify;">{{mb_strimwidth($item->doctor->education, 0, 100, "...")}}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach

                    {{$data['specialist']->links('vendor.pagination.simple-bootstrap-4')}}
                </div>
            </div>
        </div>

    </div>

</section>
@endsection

@push("js")
<script>
    $(document).ready(() => {
        $(".city").select2({
            placeholder: "Select city"
        });

        $(".doctor_select").select2({
            placeholder: "Select Doctor Name"
        });

        $("#city").on("change", (event) => {
            $.ajax({
                url: "{{route('filter.city')}}",
                method: "POST",
                dataType: "JSON",
                data: {
                    id: event.target.value,
                    doctor: 'doctor'
                },
                beforeSend: () => {
                    $("#doctor_name").html(`<option value="">Select Doctor Name</option>`)
                },
                success: (response) => {
                    if (response.null) {} else {
                        $.each(response, (index, value) => {
                            var row = `<option value="${value.name}">${value.name}</option>`;
                            $("#doctor_name").append(row)
                        })
                    }
                }
            })
        })

        function Error(err) {
            $.each(err, (index, value) => {
                $("#filterDoctor").find(".error-" + index).text(value)
            })
        }

        $("#filterDoctor").on("submit", (event) => {
            event.preventDefault()
            var formdata = new FormData(event.target)
            var doctor_name = $("#doctor_name").val()
            var city = $("#city").val()
            if (doctor_name !== "" || city !== "") {
                $.ajax({
                    url: "{{route('filter.doctor')}}",
                    method: "POST",
                    data: formdata,
                    contentType: false,
                    processData: false,
                    beforeSend: () => {
                        $("#filterDoctor").find(".error").text("")
                        $(".doctorbody").html("")
                        $(".Loading").removeClass("d-none")
                        $(".doctor_select").html(`<option value="">Select Doctor Name</option>`)
                    },
                    success: (response) => {
                        if (response.error) {
                            Error(response.error);
                        } else {
                            if (response.null) {
                                $(".doctorbody").html(`<div class="bg-dark text-white text-center">${response.null}</div>`)
                            } else {
                                if ($("#city").val()) {
                                    $(".doctor_name").addClass("d-none")
                                    $(".doctor-select").removeClass("d-none")
                                    $.each(response, (index, value) => {
                                        var raw = `<option value="${value.id}">${value.name}</option>`;
                                        $(".doctor_select").append(raw)
                                        Row(index, value)
                                    })
                                } else {
                                    $(".doctor_name").removeClass("d-none")
                                    $(".doctor-select").addClass("d-none")
                                    $.each(response, (index, value) => {
                                        Row(index, value)
                                    })
                                }
                            }
                        }
                    },
                    complete: () => {
                        $(".Loading").addClass("d-none")
                    }
                })
            } else {
                $(".error-city").text("Must be fill out one field")
            }
        })

        $(".doctor_select").on("change", event => {
            $.ajax({
                url: "{{route('filter.doctorsinglechange')}}",
                method: "POST",
                data: {
                    id: event.target.value
                },
                beforeSend: () => {
                    $(".doctorbody").html("")
                    $(".Loading").removeClass("d-none")
                },
                success: (response) => {
                    console.log(response);
                    $.each(response, (index, value) => {
                        Row(index, value);
                    })
                },
                complete: () => {
                    $(".Loading").addClass("d-none")
                }
            })
        })
    })

    function Row(index, value) {
        var row = `
            <div class="col-12 col-lg-6 mb-3">
                <a href="/single-details-doctor/${value.id}" target="_blank" class="text-decoration-none text-secondary" title="${value.name}">
                    <div class="card" style="border-radius: 0;border: 0;font-family: auto;box-shadow: 0px 0px 8px 0px #bfbfbfbf;height:130px;">
                        <div class="card-body d-flex" style="padding: 5px;gap: 8px;">
                            <div class="image" style="border: 1px dotted #ababab;height: 110px;margin-top: 4px;">
                                <img height="100%" src="${value.image != 0?location.origin+"/"+value.image:location.origin+'/uploads/nouserimage.png'}" width="100">
                            </div>
                            <div class="info" style="padding-right:5px;">
                                <h6>${value.name}</h6>
                                <p style="color:#c99913;">${value.department.length > 0 ? value.department[0].specialist.name:''}, ${value.city.name}</p>
                                <p style="border-top: 2px dashed #dddddd85;text-align:justify;">${value.education}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            `;
        $(".doctorbody").append(row)
    }
</script>
@endpush