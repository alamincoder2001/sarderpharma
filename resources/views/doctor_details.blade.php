@extends("layouts.master")
@push("js")
<style>
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

        <div class="Loading text-center d-none">
            <img src="{{asset('loading.gif')}}" width="350px">
        </div>
        <div class="row d-flex justify-content-center doctorbody">
            @foreach($data["doctor"] as $item)
            <div class="col-md-6 col-10 col-sm-6 col-lg-4 mb-4">
                <div class="card aboutdoctor" style="font-size-adjust: 0.58;">
                    <div class="card-header pl-md-1 pt-md-1 bg-body">
                        <div class="row">
                            <div class="col-md-5 col-5 p-md-0">
                                <img src="{{asset($item->image?$item->image:'frontend/img/doctor1.png')}}" class="card-img-top">
                            </div>
                            <div class="col-md-7 col-7 mt-md-2 pe-md-0">
                                <h5 class="text-uppercase">{{$item->name}}</h5>
                                <div class="speciality">
                                    <span>{{$item->department->name}}</span>
                                </div>
                                <h6 class="text-capitalize">{{$item->education}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="padding-top: 8px;">
                        <div class="location mb-1 d-flex justify-content-start align-item-center gap-1">
                            @if($item->chamber_name)
                            <i class="fa fa-home"></i> <span class="text-uppercase">{{$item->chamber_name}}</span>
                            @else
                            @if($item->hospital_id || $item->diagnostic_id)
                            <i class="fa {{$item->hospital_id?'fa-hospital-o':'fa-plus-square'}}"></i> <span class="text-uppercase">{{$item->hospital_id?$item->hospital->name:$item->diagnostic->name}}</span>
                            @endif
                            @endif
                        </div>
                        <div class="location d-flex justify-content-start align-item-center gap-1">
                            <i class="fa fa-map-marker"></i>
                            <span style="padding-left: 3px;">
                                @if($item->chamber_name)
                                {{$item->address}}, {{$item->city->name}}
                                @else
                                @if($item->hospital_id || $item->diagnostic_id)
                                {{$item->hospital_id ? $item->hospital->address:$item->diagnostic->address}}, {{$item->hospital_id ? $item->hospital->city->name:$item->diagnostic->city->name}}
                                @endif
                                @endif
                            </span>
                        </div>
                        <div class="available">
                            <div class="time d-flex align-items-center gap-1">
                                <i class="fa fa-clock-o"></i><span class="text-uppercase">Availability:</span>
                            </div>
                            <ul>
                                @foreach(explode(",", $item->availability) as $availity)
                                <li>{{ucwords($availity)}}</li>
                                @endforeach
                            </ul>
                            <small class="text-uppercase" style="margin-left: 16px;">{{date("h:i a",strtotime($item->from))}}- {{date("h:i a",strtotime($item->to))}}</small>
                        </div>
                    </div>
                    <div class="card-footer d-flex gap-2">
                        <a href="{{route('singlepagedoctor', $item->id)}}" target="_blank" class="btn btn-primary btn-sm text-uppercase">View Profile</a>
                        <a href="{{route('singlepagedoctor', $item->id)}}" target="_blank" class="btn btn-danger btn-sm text-uppercase">Quick Appoinment</a>
                    </div>
                </div>
            </div>
            @endforeach

            {{$data['doctor']->render()}}
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
        var row = `<div class="col-md-6 col-10 col-sm-6 col-lg-4 mb-4">
                <div class="card aboutdoctor">
                    <div class="card-header pl-md-1 pt-md-1 bg-body">
                        <div class="row">
                            <div class="col-md-5 col-5 p-md-0">
                                <img src="${value.image}" class="card-img-top">
                            </div>
                            <div class="col-md-7 col-7 mt-md-2 pe-md-0">
                                <h5 class="text-uppercase">${value.name}</h5>
                                <div class="speciality">
                                    <span>${value.department.name}</span>
                                </div>
                                <h6 class="text-capitalize">${value.education}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="padding-top: 8px;">
                        <div class="location mb-1 d-flex justify-content-start align-item-center gap-2">
                            ${value.chamber?'<i class="fa fa-home"></i> <span class="text-uppercase">'+value.chamber+'</span>':value.hospital_id?'<i class="fa fa-hospital-o"></i> <span class="text-uppercase">'+value.hospital.name+'</span>':'<i class="fa fa-plus-square"></i> <span class="text-uppercase">'+value.diagnostic.name+'</span>'}
                        </div>
                        <div class="location d-flex justify-content-start align-item-center gap-2">
                            <i class="fa fa-map-marker"></i>
                            <span>
                            ${value.chamber?value.address+", "+value.city.name:value.hospital_id?value.hospital.address+", "+value.city.name:value.diagnostic.address+", "+value.city.name}
                            </span>
                        </div>
                        <div class="available">
                            <div class="time d-flex align-items-center gap-1">
                                <i class="fa fa-clock-o"></i><span class="text-uppercase">Availability:</span>
                                
                            </div>
                            <ul>
                                <li>${value.availability.replaceAll(",", " ").toUpperCase()}</li>
                            </ul>
                            <small class="text-uppercase" style="margin-left: 16px;">${moment(value.from, "h:m A").format('LT')} - ${moment(value.to, "h:m A").format('LT')}</small>
                        </div>
                    </div>
                    <div class="card-footer d-flex gap-2">
                        <a href="/single-details-doctor/${value.id}" target="_blank" class="btn btn-primary btn-sm text-uppercase">View Profile</a>
                        <a href="/single-details-doctor/${value.id}" target="_blank" class="btn btn-danger btn-sm text-uppercase">Quick Appoinment</a>
                    </div>
                </div>
            </div>
            `;
        $(".doctorbody").append(row)
    }
</script>
@endpush