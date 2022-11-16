<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$setting->name}}</title>

    @include("layouts.frontend.style")
    <style>
        body {
            top: 0px !important;
            position: static !important;
        }

        .goog-te-banner-frame {
            display: none !important
        }

        .goog-te-gadget-simple {
            width: 106px !important;
            background-color: #283290 !important;
            padding: 2px !important;
            border: none !important;
            height: 35px !important;
        }

        .goog-te-gadget-simple img {
            display: none !important;
        }

        .goog-te-menu-value span {
            display: none;
            margin: -15px !important;
        }

        .goog-te-menu-value span:first-child {
            display: block;
            text-align: center;
            color: white;
        }

        .ShowSearchBtn {
            background: #24486c;
            padding: 5px;
            position: sticky;
            top: 128px;
            width: 100%;
            z-index: 99999;
        }

        .SearchBtn {
            padding: 14px;
            height: 36px;
            box-shadow: none !important;
            display: flex;
            cursor: pointer;
            align-items: center;
            border: none;
            border-radius: 0;
        }

        .select2-container--open .select2-dropdown--below {
            margin-top: 5px !important;
        }
    </style>

</head>

<body class="antialiased">
    @include("layouts.frontend.navbar")
    <div class="container searchshow mt-4 d-none">
        <div class="row d-flex justify-content-center">

        </div>
    </div>
    <main>
        @yield("content")
    </main>
    <!-- footer section -->
    @include("layouts.frontend.footer")

    @include("layouts.frontend.script")
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                includedLanguages: 'en,bn',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }

        $(".SearchBtn").on("click", event => {
            if (event.target.value == 0) {
                $(".SearchBtn").prop("value", 1)
                $(".ShowSearchBtn").removeClass("d-none")
                $("#select2").select2()
            } else {
                $(".SearchBtn").prop("value", 0)
                $(".ShowSearchBtn").addClass("d-none")
            }
        })
    </script>

    <script>
        function changeService(event) {
            $.ajax({
                url: location.origin + "/filtersingleservice",
                method: "POST",
                dataType:"JSON",
                data: {
                    service: event.target.value
                },
                beforeSend: () => {
                    $(".ShowSearchBtn").find(".searchName").html(`<option value="">Select Name</option>`)
                },
                success: res => {
                    $.each(res, (index, value) => {
                        $(".ShowSearchBtn").find(".searchName").append(`<option value="${value.id}">${value.name}</option>`)
                    })
                }
            })
        }

        function searchSubmit(event) {
            event.preventDefault();
            var formdata = new FormData(event.target)
            var selectName = $("#services option:selected").val();

            $.ajax({
                url: location.origin + "/filtersingleservice",
                method: "POST",
                dataType:"JSON",
                data: formdata,
                contentType: false,
                processData: false,
                beforeSend: () => {
                    $(".error").text("")
                    $("main").html("");
                    $(".searchshow").removeClass("d-none")
                },
                success: res => {
                    if (res.error) {
                        $.each(res.error, (index, value) => {
                            $(".error-" + index).text(value)
                        })
                    } else {
                        $(".searchshow").find(".row").html("")
                        $.each(res, (index, value) => {
                            if (selectName == "Doctor") {
                                AllDoctor(index, value);
                            } else if (selectName == "Hospital") {
                                Hospitals(index, value);
                            } else if (selectName == "Diagnostic") {
                                Diagnostics(index, value);
                            } else if (selectName == "Ambulance") {
                                Ambulances(index, value);
                            } else {
                                Privatecars(index, value);
                            }
                        })
                    }
                }
            })
        }

        function Diagnostics(index, value) {
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
            $(".searchshow").find('.row').append(row)
        }

        function Hospitals(index, value) {
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
            $(".searchshow").find('.row').append(row)
        }

        function Ambulances(index, value) {
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
            $(".searchshow").find('.row').append(row)
        }

        function Privatecars(index, value) {
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
            $(".searchshow").find('.row').append(row)
        }

        function AllDoctor(index, value) {
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
            $(".searchshow").find('.row').append(row)
        }
    </script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/63707708daff0e1306d72004/1ghnl1v8d';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
</body>

</html>