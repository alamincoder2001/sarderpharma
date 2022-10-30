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
    .diagnosticbody .card{
        position: relative;
    }
    .diagnosticbody .card .discount {
        position: absolute;
        left: 0;
        background: red;
        padding: 5px;
        color: white;
        border-radius: 100%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
    }
</style>
@endpush
@section("content")
<section id="details-diagnostic" style="padding: 25px 0;">
    <div class="container">
        <div class="doctordetail-header">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-10 col-10">
                    <form id="filterDiagnostic" class="form">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-4 col-10">
                                <div class="form-group mb-4 mb-md-0">
                                    <label for="city" class="d-md-block d-none">City</label>
                                    <select class="rounded-pill city" name="city" id="city">
                                        <option label="Select City"></option>
                                        @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="error-city error text-white"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-10">
                                <div class="form-group">
                                    <label for="diagnostic_name" class="d-md-block d-none">Diagnostic Name</label>
                                    <select class="rounded-pill diagnostic" name="diagnostic_name" id="diagnostic_name">
                                        <option label="Select Diagnostic Name"></option>
                                    </select>
                                    <span class="error-diagnostic_name error text-white"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="form-group text-center mt-1">
                                    <label for="country"></label>
                                    <button type="submit" class="btn text-white rounded-pill">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="Loading text-center d-none">
            <img src="{{asset('loading.gif')}}" width="350px">
        </div>
        <div class="row d-flex justify-content-center diagnosticbody">
            @foreach($data["diagnostic"] as $item)
            <div class="col-md-6 col-10 col-sm-6 col-lg-4">
                <div class="card border-0 mb-4" style="background: #ffffff;box-shadow:0px 0px 7px 2px #c1c1c1;">
                    <div class="img card-img-top m-auto mt-2 w-50 overflow-hidden d-flex justify-content-center border border-2">
                        <img src="{{asset($item->image?$item->image:'frontend/img/diagnostic.jpg')}}" style="width: 100%; height:160px;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center text-uppercase" style="font-size: 15px;">{{$item->name}}</h5>
                        <p class="card-text text-primary text-center mb-2"><span>{{ucwords($item->diagnostic_type)}} Diagnostic Centre</span> | <span>+880 {{substr($item->phone, 1)}}</span></p>
                        <ul style="list-style: none;padding:0 0 0 5px;">
                            <li><i style="width: 15px;height:15px;" class="fa fa-map-marker text-info"></i> <span style="font-size: 13px;">{{$item->address}}, {{$item->city->name}}</span></li>
                            <li><i style="width: 15px;height:15px;font-size:13px;" class="fa fa-envelope-o text-info"></i> <span style="font-size: 13px;">{{$item->email}}</span></li>
                        </ul>
                    </div>
                    <a href="{{route('singlepagediagnostic', $item->id)}}" target="_blank" class="text-uppercase text-white text-decoration-none text-center">
                        <div class="card-footer border-0 py-3">
                            View Details
                        </div>
                    </a>
                    @if($item->discount != 0)
                    <div class="discount">-{{$item->discount}}%</div>
                    @endif
                </div>
            </div>
            @endforeach

            {{$data['diagnostic']->render()}}
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
        $(".diagnostic").select2({
            placeholder: "Select Diagnostic Name"
        });

        $("#city").on("change", (event) => {
            $.ajax({
                url: "{{route('filter.city')}}",
                method: "POST",
                dataType: "JSON",
                data: {
                    id: event.target.value,
                    diagnostic: 'diagnostic'
                },
                beforeSend: () => {
                    $("#diagnostic_name").html(`<option value="">Select Diagnostic Name</option>`)
                },
                success: (response) => {
                    if (response.null) {} else {
                        $.each(response, (index, value) => {
                            var row = `<option value="${value.name}">${value.name}</option>`;
                            $("#diagnostic_name").append(row)
                        })
                    }
                }
            })
        })

        function Row(index, value) {
            var row = `
                <div class="col-md-6 col-10 col-sm-6 col-lg-4 ">
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
                    ${value.discount!=0?"<div class='discount'>-"+value.discount+"%</div>":""}
                </div>
            </div>
                `;
            $(".diagnosticbody").append(row)

        }

        function Error(err) {
            $.each(err, (index, value) => {
                $("#filterDiagnostic").find(".error-" + index).text(value)
            })
        }

        $("#filterDiagnostic").on("submit", (event) => {
            event.preventDefault();
            var formdata = new FormData(event.target)
            $.ajax({
                url: "{{route('filter.diagnostic')}}",
                method: "POST",
                dataType: "JSON",
                data: formdata,
                contentType: false,
                processData: false,
                beforeSend: () => {
                    $("#filterDiagnostic").find(".error").text("")
                    $(".Loading").removeClass("d-none")
                    $(".diagnosticbody").html("")
                },
                success: (response) => {
                    if (response.error) {
                        $(".diagnosticbody").html(`<div class="bg-dark text-white text-center">No Data Found</div>`)
                        Error(response.error);
                    } else {
                        if (response.null) {
                            $(".diagnosticbody").html(`<div class="bg-dark text-white text-center">${response.null}</div>`)
                        } else {
                            $.each(response, (index, value) => {
                                Row(index, value)
                            })
                        }
                    }
                },
                complete: () => {
                    $(".Loading").addClass("d-none")
                }
            })
        })
    })
</script>
@endpush