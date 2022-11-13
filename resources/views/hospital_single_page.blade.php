@extends("layouts.master")

@push('style')

@section("content")
<section id="appointment" style="padding: 55px 0;">
    <div class="container">
        <div class="singlehospital">
            <div class="card">
                <div class="card-header py-4" style="background: #0B1B67;height: 150px;display: flex;justify-content: center;align-items: center;">
                    <h2 class="text-white text-center">{{$data->name}}</h2>
                </div>
                <div class="card-body" style="position: relative;">
                    <div class="imghospital" style="width: 150px !important;position: absolute;top: -100px;">
                        <img src="{{asset($data->image?$data->image:'frontend/img/hospital.jpg')}}" class="border rounded" style="width: 100%; height:145px;">
                    </div>
                    <div class="hospital-body" style="margin-top: 55px;">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-3 d-flex align-items-center justify-content-start">
                                <div class="phone d-flex align-items-center">
                                    <i class="fa fa-phone fs-3" style="background: #1ead29;color: white;padding: 6px 10px;margin-right:10px;"></i> <span> Hotline: 24 Hours <br>+880 {{substr($data->phone, 1)}}</span>
                                </div>
                            </div>
                            <div class="col-md-3 d-flex align-items-center justify-content-start">
                                <div class="location d-flex align-items-center">
                                    <i class="fa fa-map-marker fs-3" style="background: #bf2c3a;color: white;padding: 5px 12px;margin-right:10px;"></i> <span>{{$data->address}}, {{$data->city->name}}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="map">
                                    {!!$data->map_link?$data->map_link:''!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="from-group">
                            <select id="Department" data-id="{{$data->id}}" class="form-control bg-danger text-white">
                                <option value="">All Department</option>
                                @foreach($departments as $sp)
                                <option value="{{$sp->id}}">{{$sp->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row showDoctor pl-2">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-body">
                <p style="text-align: justify;">
                    At the very arena of globalization and technological innovation, hospital services have become competitive. Among the hospitals ‘KC Hospital & Diagnostic Centre’ is emerging in the market with a better position. This hospitals is organized by the retired army person. As a part of my internship program it was assigned me to work with KC Hospital & Diagnostic Centre. This report is prepared as a partial fulfillment for the MBA program of the Faculty of Business Administration under Chittagong University of Bangladesh. The report is prepared Information & Service procedures of KC Hospital & Diagnostic Centre. A study on K C Plaza, 2620 Nowapara, Dakkhinkhan, Uttara, Dhaka-1230 KC Hospital & Diagnostic Centre ,the main focus of this report is Information & Service procedures . This report contains seven main parts. First part is about KC Hospital & Diagnostic Centre. Second part is OPD Services. In the OPD Service parts I just show an overview of KC Hospital & Diagnostic Centre of their Outpatient Facilities and Medical Specialties. Third part is IPD Services. In this part all information is collected from the respective KC Hospital & Diagnostic Centre, here I also discuss about IPD Patient of KC Hospital & Diagnostic Centre which is the important part of his of this report. Part four contains Ancillary Services. In part five my internship position and major learning point has described. KC Hospital & Diagnostic Centre performance growth is prodigious as well as to increase their customer. KC Hospital & Diagnostic Centre, a concern of NIPA Group is a 150-bed tertiary care hospital. KC Hospital is located in the Dakkhinkhan, Uttara of Dhaka and aims to serve people of Dakkhinkhan, Uttara and greater portion of the city. The hospital building is 11 stories and is approximately 110,000sqft . The outpatient department of this hospital can serve up to 400 patients daily, through 25 examination rooms. To ensure optimum healthcare-hospitality, the patients are closely monitored in their waiting times in outpatient clinics, emergency and admissions.
                </p>
            </div>
        </div>

        <div class="newsletter">
            <h4 class="text-center mt-3">NEWS & EVENTS</h4>
            <p class="text-center">Find upcoming and ongoing medical conference, meetings, events
                medical fairs and trade shows near you</p>

            <div class="card mt-4">
                <div class="card-header" style="background: #023256;">
                    <h4 class="text-white">GET IN TOUCH</h4>
                </div>
                <div class="card-body">
                    <form class="addContact">
                        <input type="hidden" id="hospital" name="hospital" value="hospital">
                        <input type="hidden" id="hospital_id" name="hospital_id" value="{{$data->id}}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name">
                                    <span class="error-name error text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                    <span class="error-email error text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">Contact</label>
                                    <input type="text" name="phone" class="form-control" placeholder="+880 1737 484046">
                                    <span class="error-phone error text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <input type="text" name="subject" class="form-control" placeholder="Subject">
                                    <span class="error-subject error text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea class="form-control" name="message" placeholder="Message"></textarea>
                                    <span class="error-message error text-danger"></span>
                                </div>
                            </div>
                            <div class="clearfix border-top mt-3"></div>
                            <div class="form-group mt-3 text-center">
                                <button type="submit" class="btn btn-outline-primary">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

@push("js")
<script>
    $(document).ready(() => {
        $("iframe").attr("width", "100%").attr("height", "80%");

        $("#Department").on("change", (event) => {
            if (event.target.value !== null) {
                var id = $("#Department").attr("data-id");
                $.ajax({
                    url: "{{route('filter.hospitaldiagnosticdoctor')}}",
                    method: "POST",
                    data: {
                        department: event.target.value
                    },
                    success: (response) => {
                        if (response.null) {
                            $(".showDoctor").html(`<div class="text-center">${response.null}</div>`)
                        } else {
                            $(".showDoctor").html("")
                            $.each(response, (index, value) => {
                                if (value.doctor.hospital_id == id) {
                                    var row = `
                                            <div class="col-md-4 mb-3">
                                                <div class="card mt-3 border-bottom">
                                                    <div class="card-body d-flex gap-2">
                                                        <img src="${document.location.origin+"/"+value.doctor.image}" width="100" height="100" style="border: 1px solid gray;padding:3px;">
                                                        <div class="body">
                                                            <h6>${value.doctor.name}</h6>
                                                            <p>${value.doctor.education}</p>
                                                        </div>                                        
                                                    </div>
                                                    <div class="card-footer text-end">
                                                        <a href="/single-details-doctor/${value.doctor.id}" target="_blank" class="btn btn-info btn-sm">Appointment</a>
                                                    </div>
                                                </div>
                                            </div>
                                        `;
                                    $(".showDoctor").append(row)
                                }
                            })
                        }
                    }
                })
            }
        })

        // Hospital store
        $(".addContact").on("submit", event => {
            event.preventDefault()
            var formdata = new FormData(event.target)
            $.ajax({
                url: "{{route('hospitaldiagnosticcontact')}}",
                method: "POST",
                data: formdata,
                processData: false,
                contentType: false,
                beforeSend: () => {
                    $(".addContact").find(".error").text("")
                },
                success: response => {
                    if (response.error) {
                        $.each(response.error, (index, value) => {
                            $(".addContact").find(".error-" + index).text(value)
                        })
                    } else {
                        $(".addContact").trigger("reset")
                        $.notify(response, "success");
                    }
                }
            })
        })
    })
</script>
@endpush