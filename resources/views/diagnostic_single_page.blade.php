@extends("layouts.master")

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
                        <img src="{{asset($data->image?$data->image:'frontend/img/diagnostic.jpg')}}" class="border rounded" style="width: 100%; height:150px;">
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
                                    {!! $data->map_link !!}
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
                        <input type="hidden" id="diagnostic" name="diagnostic" value="diagnostic">
                        <input type="hidden" id="diagnostic_id" name="diagnostic_id" value="{{$data->id}}">
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
                    dataType: "JSON",
                    data: {
                        id: id,
                        name: "diagnostic_id",
                        department: event.target.value
                    },
                    success: (response) => {
                        if (response.null) {
                            $(".showDoctor").html(`<div class="text-center">${response.null}</div>`)
                        } else {
                            $(".showDoctor").html("")
                            $.each(response, (index, value) => {
                                var row = `
                                        <div class="col-md-4 mb-3">
                                            <div class="card mt-3 border-bottom">
                                                <div class="card-body d-flex gap-2">
                                                    <img src="${document.location.origin+"/"+value.image}" width="100" height="100" style="border: 1px solid gray;padding:3px;">
                                                    <div class="body">
                                                        <h6>${value.name}</h6>
                                                        <p>${value.education}</p>
                                                    </div>                                        
                                                </div>
                                                <div class="card-footer text-end">
                                                    <a href="/single-details-doctor/${value.id}" target="_blank" class="btn btn-info btn-sm">Appointment</a>
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                $(".showDoctor").append(row)
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