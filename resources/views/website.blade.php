@extends("layouts.master")

@push("style")
<style>
    .carbtn {
        width: 12px !important;
        height: 12px !important;
        border-radius: 50%;
        background: transparent !important;
        border: 1px solid #fff !important;
    }

    .homeBtn:focus {
        background: green;
    }

    .message-body .image {
        width: 150px;
        height: 150px;
        background: gray;
        border-radius: 50%;
        overflow: hidden;
        margin: 10px auto;
    }

    #testmonial .message-body {
        width: 500px;
        margin: 30px auto;
    }

    .departments {
        background: linear-gradient(45deg, #0718e7, #00a10c) !important;
    }

    .department {
        border: none;
        border-radius: 15px;
        width: 100%;
        height: 110px;
        display: flex;
        align-items: center;
        background: #050d6ceb;
        text-align: center;
        color: white;
        cursor: pointer;
        text-transform: uppercase;
        font-family: sans-serif;

    }

    /* select 2 style */
    .select2-container--default .select2-selection--single {
        border: 0 !important;
        border-radius: 0;
    }

    .select2-container .select2-selection--single {
        height: 32px !important;
        background: black !important;
        border-radius: 5rem !important;
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

<!-- carousel part -->
<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach($data["slider"] as $key => $item)
        <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="{{$key}}" class="{{$key==0?'active':''}}" aria-current="{{$key==0?'true':''}}" aria-label="{{$key}}"></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach($data["slider"] as $key => $item)
        <div class="carousel-item {{$key==0?'active':''}}" ata-bs-interval="10000" style="background: url('{{asset($item->image)}}');">
            <!-- <div class="carousel-caption d-md-block">
                <h5>{{$item->title}}</h5>
                <p>{{$item->short_text}}</p>
            </div> -->
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" style="opacity: unset;" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> -->
        <i class="fa fa-chevron-left" style="display: flex;align-items: center;background: #283290;padding: 10px 13px;"></i>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" style="opacity: unset;" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <!-- <span class="carousel-control-next-icon" aria-hidden="true"></span> -->
        <i class="fa fa-chevron-right" style="display: flex;align-items: center;background: #283290;padding: 10px 13px;"></i>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<section id="search">
    <div class="container">
        <div class="search">
            <div class="row">
                <div class="col-md-12 col-12">
                    <form id="fillterWebsite">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-6 col-lg-3 col-6">
                                <div class="form-group mb-4 mb-md-0">
                                    <label for="city" class="d-lg-block d-none">City</label>
                                    <select name="city" id="city" class="rounded-pill city">
                                        <option label="Select City"></option>
                                        @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="error-city text-white"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 col-6">
                                <div class="form-group mb-4 mb-md-0">
                                    <label for="service" class="d-lg-block d-none">Service</label>
                                    <select name="service" id="country" class="service rounded-pill">
                                        <option label="Select Service"></option>
                                    </select>
                                    <span class="error-service text-white"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 col-6">
                                <div class="form-group">
                                    <label for="country" class="d-lg-block d-none">Select <span id="Name"></span> Name</label>
                                    <select name="country" id="country" class="Name rounded-pill">
                                        <option label="Select Name"></option>
                                    </select>
                                    <span class="error-country text-white"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 col-6 mt-0 mt-md-4">
                                <div class="form-group text-center">
                                    <button type="submit" class="btn text-white homeBtn rounded-pill">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- header section end -->

<!-- service section -->
<div id="show">
    <div class="container">
        <div class="Loading text-center d-none">
            <img src="{{asset('loading.gif')}}" width="350px">
        </div>
        <div class="row main-show d-flex justify-content-center">

        </div>
    </div>
</div>
<section id="service" class="bg-light">
    <div class="container">
        <div class="service-header text-center">
            <h2 class="text-uppercase">Our Services</h2>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10 col-10 col-sm-10 col-lg-3 mb-5">
                <div class="service-body">
                    <h6 class="text-uppercase mt-2">Find Your Doctors</h6>
                    <h5>BOOK YOUR APPOINTMENT</h5>
                    <p class="mb-3">Search doctors by name, city, specialty, expertise to book an appointment</p>
                    <a href="{{route('doctor.details')}}" class="btn text-white text-uppercase">Find doctor</a>
                    <div class="servic-icon">
                        <i class="fa fa-user-md"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-10 col-sm-10 col-lg-3 mb-5">
                <div class="service-body">
                    <h6 class="text-uppercase mt-2">FIND YOUR HOSPITAL</h6>
                    <h5>HOSPITAL AROUND YOU</h5>
                    <p class="mb-3">Search private and government hospitals to meet your need to know the facilities</p>
                    <a href="{{route('hospital.details')}}" class="btn text-white text-uppercase">find hospital</a>
                    <div class="servic-icon">
                        <i class="fa fa-hospital-o"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-10 col-sm-10 col-lg-3 mb-5">
                <div class="service-body">
                    <h6 class="text-uppercase mt-2">FIND DIAGNOSTIC SERVICE</h6>
                    <h5>GET DIAGNOSTICE SERVICE NEAR YOU</h5>
                    <p class="mb-3">Search diagnostic near you to get proper investigation report near you to</p>
                    <a href="{{route('diagnostic.details')}}" class="btn text-white text-uppercase">Find DIAGNOSTIC</a>
                    <div class="servic-icon">
                        <i class="fa fa-plus"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-10 col-sm-10 col-lg-3 mb-5">
                <div class="service-body">
                    <h6 class="text-uppercase mt-2">Find Ambulance Service</h6>
                    <h5>15 MINUTES QUICK SERVICE</h5>
                    <p class="mb-3">Get any types of ambulance to reach any hospitals or any corner of Bangladesh</p>
                    <a href="{{route('ambulance.details')}}" class="btn text-white text-uppercase">Find Ambulance</a>
                    <div class="servic-icon">
                        <i class="fa fa-ambulance"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-10 col-sm-10 col-lg-3 mb-5">
                <div class="service-body">
                    <h6 class="text-uppercase mt-2">Find Privatecar Service</h6>
                    <h5>15 MINUTES QUICK SERVICE</h5>
                    <p class="mb-3">Get any types of privatecar to reach any hospitals or any corner of Bangladesh</p>
                    <a href="{{route('privatecar.details')}}" class="btn text-white text-uppercase">Find Privatecar</a>
                    <div class="servic-icon">
                        <i class="fa fa-car"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-10 col-sm-10 col-lg-3 mb-5">
                <div class="service-body">
                    <h6 class="text-uppercase mt-2">Find Pathology Service</h6>
                    <h5>15 MINUTES QUICK SERVICE</h5>
                    <p class="mb-3">Search pathology and take service</p>
                    <a href="{{route('pathology')}}" class="btn text-white text-uppercase">Find Pathology</a>
                    <div class="servic-icon">
                        <i class="fa fa-stethoscope"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- doctor section -->

<section style="padding:55px 0; background: #DDDDDD;">
    <div class="container">
        <div class="doctor-header">
            <h2 class="text-uppercase text-center mb-5">Specialist</h2>
        </div>
        <div class="row">
            @foreach($departments as $item)
            <!-- style="background: #002a68;" value="{{$item->id}}" class="department item{{$item->id}}" -->
            <div class="col-6 col-lg-2">
                <a onclick="departmentWiseDoctor(event, {{$item->id}})">
                    <div class="card department item{{$item->id}} mb-4">
                        <div class="card-body d-flex align-items-center">
                            <p>{{$item->name}}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        <div class="borderShow d-none" style="border-top: 3px dotted #c5c3c3;padding-top: 5px;"></div>
        <div class="Loading1 text-center d-none">
            <img src="{{asset('loading.gif')}}" width="350px">
        </div>
        <div class="row d-flex justify-content-center addDepartment">
        </div>
    </div>
</section>

<!-- our facilitics -->
<section id="facilities">
    <div class="container">
        <div class="facilities-header text-center">
            <h2 class="text-uppercase">Our facilities</h2>
            <p class="mb-5">Ea melius ceteros oportere quo, pri habeo viderer facilisi ei</p>
        </div>


        <div class="facilities owl-carousel owl-theme owl-loaded">
            <div class="item">
                <a href="{{asset('frontend')}}/img/1.jpg">
                    <img src="{{asset('frontend')}}/img/1.jpg" alt="">
                </a>
            </div>
            <div class="item">
                <a href="{{asset('frontend')}}/img/2.jpg">
                    <img src="{{asset('frontend')}}/img/2.jpg" alt="">
                </a>
            </div>
            <div class="item">
                <a href="{{asset('frontend')}}/img/3.jpg">
                    <img src="{{asset('frontend')}}/img/3.jpg" alt="">
                </a>
            </div>
            <div class="item">
                <a href="{{asset('frontend')}}/img/4.jpg">
                    <img src="{{asset('frontend')}}/img/4.jpg" alt="">
                </a>
            </div>
            <div class="item">
                <a href="{{asset('frontend')}}/img/5.jpg">
                    <img src="{{asset('frontend')}}/img/5.jpg" alt="">
                </a>
            </div>
            <div class="item">
                <a href="{{asset('frontend')}}/img/6.jpg">
                    <img src="{{asset('frontend')}}/img/6.jpg" alt="">
                </a>
            </div>
            <div class="item">
                <a href="{{asset('frontend')}}/img/6.jpg">
                    <img src="{{asset('frontend')}}/img/6.jpg" alt="">
                </a>
            </div>
            <div class="item">
                <a href="{{asset('frontend')}}/img/6.jpg">
                    <img src="{{asset('frontend')}}/img/6.jpg" alt="">
                </a>
            </div>
        </div>
    </div>
</section>

<!-- testmonial section -->
<section id="testmonial" style="background: #283290;padding:45px 0;">
    <h2 class="text-center text-uppercase" style="font-size: 25px;font-weight: revert;color: #ff8a60;">Our Clients Says<span>"</span></h2>
    <div class="container">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active carbtn" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" class="carbtn" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" class="carbtn" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" class="carbtn" aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" class="carbtn" aria-label="Slide 5"></button>
            </div>
            <div class="carousel-inner" style="height: 350px;">
                <div class="carousel-item active">
                    <div class="message-body text-center">
                        <p class="text-light">Some representative placeholder content for the first slide.</p>
                        <h5 class="text-light">Monalisha Aktar</h5>
                        <div class="image">
                            <img src="{{asset('frontend')}}/img/doctor1.png" style="transform: scale(0.9);" width="100%">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="message-body text-center">
                        <p class="text-light">Paragraphs are units of writing larger than a sentence and smaller than a section and generally express a single idea or topic. Proper paragraphing and paragraph writing have several key benefits in medical writing which include organizing the meaning of the text, making the text readable and visually pleasing</p>
                        <h5 class="text-light">Jahanara Begum</h5>
                        <div class="image">
                            <img src="{{asset('frontend')}}/img/doctor2.png" style="transform: scale(0.9);" width="100%">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="message-body text-center">
                        <p class="text-light">Some representative placeholder content for the first slide.</p>
                        <h5 class="text-light">Shamsunnahar</h5>
                        <div class="image">
                            <img src="{{asset('frontend')}}/img/doctor4.png" style="transform: scale(0.9);" width="100%">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="message-body text-center">
                        <p class="text-light">Some representative placeholder content for the first slide.</p>
                        <h5 class="text-light">Shamsunnahar</h5>
                        <div class="image">
                            <img src="{{asset('frontend')}}/img/doctor4.png" style="transform: scale(0.9);" width="100%">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="message-body text-center">
                        <p class="text-light">Some representative placeholder content for the first slide.</p>
                        <h5 class="text-light">Shamsunnahar</h5>
                        <div class="image">
                            <img src="{{asset('frontend')}}/img/doctor4.png" style="transform: scale(0.9);" width="100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- corporate partner -->
<section id="corporate" style="padding: 55px 0;background:#ededed;">
    <div class="container">
        <div class="corporate-header text-center">
            <h2 style="font-size: 25px;font-weight: revert;color: #7a5c51;" class="text-uppercase">Our Corporate Partner</h2>
            <p class="mb-5">Ea melius ceteros oportere quo, pri habeo viderer facilisi ei</p>
        </div>


        <div class="corporate owl-carousel owl-theme owl-loaded">
            @foreach($data["partner"] as $item)
            <div class="item">
                <img src="{{asset($item->image)}}" width="100" alt="">
            </div>
            @endforeach
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
        $(".Name").select2({
            placeholder: "Select Name"
        });

        $("#city").on("change", (event) => {
            var arr = ["Doctor", "Hospital", "Diagnostic", "Ambulance", "Privatecar"]
            $(".service").html(`<option value="">Select Service</option>`)
            $("#Name").html("")
            $(".Name").html(`<option value="">Select Name</option>`)
            if (event.target.value) {
                $.each(arr, (index, value) => {
                    $(".service").append(`<option value="${value}">${value}</option>`)
                })
            }
        })
        $(document).on("change", ".service", (event) => {
            if (event.target.value) {
                $.ajax({
                    url: "{{route('filter.city')}}",
                    method: "POST",
                    data: {
                        id: $("#city").val(),
                        service: $(".service").val()
                    },
                    beforeSend: () => {
                        $(".Name").html(`<option value="">Select ${event.target.value} Name</option>`)
                        $("#Name").html(event.target.value)
                    },
                    success: (response) => {
                        if (response.null) {} else {
                            $.each(response, (index, value) => {
                                var row = `<option value="${value.name}">${value.name}</option>`;
                                $(".Name").append(row)
                            })
                        }
                    }
                })
            } else {
                $("#Name").html(event.target.value)
                $(".Name").html(`<option value="">Select ${event.target.value} Name</option>`)
            }
        })

        $("#fillterWebsite").on("submit", (event) => {
            event.preventDefault();
            var ci = $("#city").val();
            var city = $(".service").val();
            $(".error-city").text("")
            $(".error-service").text("")
            if (ci !== "") {
                if (city !== "") {
                    if (city == "Doctor") {
                        var url = "{{route('filter.doctor')}}"
                        var formdata = {
                            city: ci,
                            doctor_name: $(".Name").val()
                        }
                        Filter(formdata, url, city)
                    } else if (city == "Hospital") {
                        var url = "{{route('filter.hospital')}}"
                        var formdata = {
                            city: ci,
                            hospital_name: $(".Name").val()
                        }
                        Filter(formdata, url, city)
                    } else if (city == "Diagnostic") {
                        var url = "{{route('filter.diagnostic')}}"
                        var formdata = {
                            city: ci,
                            diagnostic_name: $(".Name").val()
                        }
                        Filter(formdata, url, city)
                    } else if (city == "Privatecar") {
                        var url = "{{route('filter.privatecar')}}"
                        var formdata = {
                            city: ci,
                            privatecar_name: $(".Name").val()
                        }
                        Filter(formdata, url, city)
                    } else {
                        var url = "{{route('filter.ambulance')}}"
                        var formdata = {
                            city: ci,
                            ambulance_name: $(".Name").val()
                        }
                        Filter(formdata, url, city)
                    }
                } else {
                    $(".error-service").text("Must be select service")
                }
            } else {
                $(".error-city").text("Select city first")
            }
        })

        function Filter(formdata, url, city) {
            $.ajax({
                url: url,
                method: "POST",
                data: formdata,
                beforeSend: () => {
                    ClearAll()
                    $("#fillterWebsite").find(".error").text("")
                    $(".error-city").text("")
                    $(".error-service").text("")
                    $(".main-show").html("");
                    $(".Loading").removeClass("d-none")
                },
                success: (response) => {
                    if (response.error) {
                        $(".error-city").text(response.error.city)
                    } else {
                        if (response.null) {
                            $(".main-show").html(`<p>${response.null}</p>`);
                        } else {
                            $.each(response, (index, value) => {
                                $(".main-show").css({
                                    padding: "55px 0"
                                })
                                if (city == "Doctor") {
                                    Doctor(index, value)
                                } else if (city == "Diagnostic") {
                                    Diagnostic(index, value)
                                } else if (city == "Hospital") {
                                    Hospital(index, value)
                                } else if (city == "Privatecar") {
                                    Privatecar(index, value)
                                } else {
                                    Ambulance(index, value)
                                }
                            })
                        }
                    }
                },
                complete: () => {
                    $(".Loading").addClass("d-none")
                }
            })
        }
    })

    function Doctor(index, value) {
        var row = `
                <div class="col-md-6 col-10 col-sm-6 col-lg-4 mb-4">
                    <div class="card aboutdoctor">
                        <div class="card-header pl-md-1 pt-md-1 bg-body">
                            <div class="row">
                                <div class="col-md-5 col-5 p-md-0">
                                    <img src="${value.image}" class="card-img-top">
                                </div>
                                <div class="col-md-7 col-7 mt-md-2 pe-md-0">
                                    <h5 class="text-uppercase">${value.name}</h5>
                                    <div class="speciality">
                                        <span>${value.department.length !=0?value.department[0].specialist.name:""}</span>
                                    </div>
                                    <h6 class="text-capitalize">${value.education}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="padding-top: 8px;">
                            <div class="location mb-1 d-flex justify-content-start align-item-center gap-2">
                                ${value.chamber.length!=0?'<i class="fa fa-home"></i> <span class="text-uppercase">'+value.chamber[0].name+'</span>':value.hospital_id?'<i class="fa fa-hospital-o"></i> <span class="text-uppercase">'+value.hospital.name+'</span>':'<i class="fa fa-plus-square"></i> <span class="text-uppercase">'+value.diagnostic.name+'</span>'}
                            </div>
                            <div class="location d-flex justify-content-start align-item-center gap-2">
                                <i class="fa fa-map-marker"></i>
                                <span>
                                ${value.chamber.length!=0?value.chamber[0].address+", "+value.city.name:value.hospital_id?value.hospital.address+", "+value.city.name:value.diagnostic.address+", "+value.city.name}
                                </span>
                            </div>
                            <div class="available">
                                <div class="time d-flex align-items-center gap-1">
                                    <i class="fa fa-clock-o"></i><span class="text-uppercase">Availability:</span>
                                    
                                </div>
                                <ul>
                                    <li>${value.availability.replaceAll(",", " ").toUpperCase()}</li>
                                </ul>
                                <small class="text-uppercase" style="margin-left: 16px;">${moment(value.time.length!=0?value.time[0].from:"", "h:m A").format('LT')} - ${moment(value.time.length!=0?value.time[0].to:"", "h:m A").format('LT')}</small>
                            </div>
                        </div>
                        <div class="card-footer d-flex gap-2">
                            <a href="/single-details-doctor/${value.id}" target="_blank" class="btn btn-primary btn-sm text-uppercase">View Profile</a>
                            <a href="/single-details-doctor/${value.id}" target="_blank" class="btn btn-danger btn-sm text-uppercase">Quick Appoinment</a>
                        </div>
                    </div>
                </div>
            `;
        $(".main-show").append(row)
    }

    function Diagnostic(index, value) {
        var row = `
            <div class="col-md-6 col-10 col-sm-6 col-lg-4 diagnosticbody">
                <div class="card border-0 mb-4" style="background: #ffffff;box-shadow:0px 0px 7px 2px #c1c1c1;">
                    <div class="img card-img-top m-auto mt-2 w-50 overflow-hidden d-flex justify-content-center border border-2">
                        <img src="${value.image?value.image:'frontend/img/hospital.jpg'}" style="width: 100%; height:160px;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center" style="font-size: 15px;">${value.name}</h5>
                        <p class="card-text text-primary text-center mb-2"><span>${value.diagnostic_type.toUpperCase()}</span> | <span>+880 ${value.phone.substr(1)}</span></p>
                        <ul style="list-style: none;padding:0 0 0 5px;">
                            <li><i style="width: 15px;height:15px;" class="fa fa-map-marker text-info"></i> <span style="font-size: 13px;">${value.address}, ${value.city.name}</span></li>
                            <li><i style="width: 15px;height:15px;font-size:13px;" class="fa fa-envelope-o text-info"></i> <span style="font-size: 13px;">${value.email}</span></li>
                        </ul>
                    </div>
                    <a class="text-decoration-none text-white text-uppercase" target="_blank" href="${'/single-details-diagnostic/'+value.id}">
                    <div class="card-footer border-0 text-center py-3">
                        View Details
                    </div>
                    </a>
                    ${value.discount_amount!=0?"<div class='discount'>-"+value.discount_amount+"%</div>":""}
                </div>
            </div>
        `;
        $(".main-show").append(row)
    }

    function Hospital(index, value) {
        var row = `
                <div class="col-md-6 col-10 col-sm-6 col-lg-4 hospitalbody">
                    <div class="card border-0 mb-4" style="background: #ffffff;box-shadow:0px 0px 7px 2px #c1c1c1;">
                        <div class="img card-img-top m-auto mt-2 w-50 overflow-hidden d-flex justify-content-center border border-2">
                            <img src="${value.image?value.image:'frontend/img/hospital.jpg'}" style="width: 100%; height:160px;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-center" style="font-size: 15px;">${value.name}</h5>
                            <p class="card-text text-primary text-center mb-2"><span>${value.hospital_type.toUpperCase()}</span> | <span>+880 ${value.phone.substr(1)}</span></p>
                            <ul style="list-style: none;padding:0 0 0 5px;">
                                <li><i style="width: 15px;height:15px;" class="fa fa-map-marker text-info"></i> <span style="font-size: 13px;">${value.address}, ${value.city.name}</span></li>
                                <li><i style="width: 15px;height:15px;font-size:13px;" class="fa fa-envelope-o text-info"></i> <span style="font-size: 13px;">${value.email}</span></li>
                            </ul>
                        </div>
                        <a class="text-decoration-none text-white text-uppercase" target="_blank" href="${'/single-details-hospital/'+value.id}">
                        <div class="card-footer border-0 text-center py-3">
                            View Details
                        </div>
                        </a>
                        ${value.discount_amount!=0?"<div class='discount'>-"+value.discount_amount+"%</div>":""}
                    </div>
                </div>
        `;
        $(".main-show").append(row)
    }

    function Ambulance(index, value) {
        var row = `
            <div class="col-md-6 col-10 col-sm-6 col-lg-4 ambulancebody">
                <div class="card border-0 mb-4" style="background: #ffffff;box-shadow:0px 0px 7px 2px #c1c1c1;height:400px;font-size-adjust: 0.58;">
                    <div class="img card-img-top m-auto mt-2 w-50 overflow-hidden d-flex justify-content-center border border-2">
                        <img src="${value.image}" style="width: 100%; height:160px;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center" style="font-size: 15px;">${value.name}</h5>
                        <p class="card-text text-primary text-center mb-2"><span>${value.ambulance_type.replaceAll(",", " | ")}</span></p>
                        <ul style="list-style: none;padding:0 0 0 5px;">
                            <li><i style="width: 15px;height:15px;" class="fa fa-phone text-info"></i> <span style="font-size: 13px;">+880 ${value.phone.substr(1)}</span></li>
                            <li><i style="width: 15px;height:15px;" class="fa fa-map-marker text-info"></i> <span style="font-size: 13px;">${value.address}, ${value.city.name}</span></li>
                            <li><i style="width: 15px;height:15px;font-size:13px;" class="fa fa-envelope-o text-info"></i> <span style="font-size: 13px;">${value.email}</span></li>
                        </ul>
                    </div>
                    <a href="${'single-details-ambulance/'+value.id}" target="_blank" class="text-uppercase text-white text-decoration-none text-center">
                        <div class="card-footer border-0 py-3">
                            View Details
                        </div>
                    </a>
                </div>
            </div>
        `;
        $(".main-show").append(row)
    }

    function Privatecar(index, value) {
        var row = `
            <div class="col-md-6 col-10 col-sm-6 col-lg-4 privatecarbody">
                <div class="card border-0 mb-4" style="background: #ffffff;box-shadow:0px 0px 7px 2px #c1c1c1;">
                    <div class="img card-img-top m-auto mt-2 w-50 overflow-hidden d-flex justify-content-center border border-2">
                        <img src="${value.image}" style="width: 100%; height:160px;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center" style="font-size: 15px;">${value.name}</h5>
                        <p class="card-text text-primary text-center mb-2"><span>${value.cartype_id.replaceAll(",", " | ")}</span></p>
                        <ul style="list-style: none;padding:0 0 0 5px;">
                            <li><i style="width: 15px;height:15px;" class="fa fa-phone text-info"></i> <span style="font-size: 13px;">+880 ${value.phone.substr(1)}</span></li>
                            <li><i style="width: 15px;height:15px;" class="fa fa-map-marker text-info"></i> <span style="font-size: 13px;">${value.address}, ${value.city.name}</span></li>
                            <li><i style="width: 15px;height:15px;font-size:13px;" class="fa fa-envelope-o text-info"></i> <span style="font-size: 13px;">${value.email}</span></li>
                        </ul>
                    </div>
                    <a href="${'single-details-privatecar/'+value.id}" target="_blank" class="text-uppercase text-white text-decoration-none text-center">
                        <div class="card-footer border-0 py-3">
                            View Details
                        </div>
                    </a>
                </div>
            </div>
            `;
        $(".main-show").append(row)

    }

    function ClearAll() {
        $("#service").addClass("d-none")
        $("#doctor").addClass("d-none")
        $("#facilities").addClass("d-none")
        $("#testmonial").addClass("d-none")
        $("#corporate").addClass("d-none")
    }


    // departmentwise doctor filter
    function departmentWiseDoctor(event, id) {
        $(".department").removeClass("departments")
        $(".item" + id).addClass("departments")
        $(".borderShow").removeClass("d-none")
        $.ajax({
            url: "{{route('home.filter')}}",
            method: "POST",
            data: {
                department_id: id
            },
            beforeSend: () => {
                $(".addDepartment").html("")
                $(".Loading1").removeClass("d-none")
            },
            success: response => {
                $.each(response, (index, value) => {
                    let row = `
                            <div class="col-md-6 mb-3 col-10 col-sm-10 col-lg-3">
                                <a class="text-decoration-none" href="/single-details-doctor/${value.doctor.id}">
                                <div class="card border-0" style="border-radius: 0;box-shadow:0px 0px 15px 0px #c5c1c1;">
                                        <img src="${value.doctor.image!=0?location.origin+"/"+value.doctor.image:location.origin+'/frontend/nodoctorimage.png'}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <p style="color:#f59217;font-size: 15px;font-weight: 500;">${value.doctor.name}</p>
                                            <h5 class="card-title">${value.specialist.name}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            `;
                    $(".addDepartment").append(row)
                })
            },
            complete: () => {
                $(".Loading1").addClass("d-none")
            }
        })
    }
</script>
@endpush