@extends("layouts.master")
@push("style")
<style>
    .contact-heading {
        background-image: url("{{asset('frontend')}}/img/contactus.jpg");
        background-size: 100% 100%;
        background-position: center;
        background-repeat: no-repeat;
        height: 235px;
    }

    #contact-us .contact-body i {
        font-size: 35px;
        font-weight: 900;
    }

    #contact-us .contact-body .fa-phone {
        color: #00aba3;
    }

    #contact-us .contact-body .fa-map-marker {
        color: #F60002;
    }

    #contact-us .contact-body .fa-envelope-o {
        color: #168BE4;
    }

    #contact-us .contact-body small {
        color: #8d8d8dcf;
    }
</style>
@endpush
@section("content")
@php
$data = App\Models\Test::orderBy("name")->get();
@endphp
<section id="contact-us">
    <div class="contact-heading d-flex align-items-center justify-content-start text-white" style="background: url('{{asset('frontend/img/pathology.jpg')}}');">
        <div class="container">
            <h2 class="text-uppercase text-dark">Pathology Section</h2>
        </div>
    </div>

    <div class="contact-form" style="background: #f3f3f3;">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-6">
                    <form onsubmit="addPathology(event)">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-2 d-flex align-items-center" style="position: relative;">
                                        <img src="{{asset('noimage.jpg')}}" style="position: absolute;width: 100%;height: 100%;" class="img" width="100">
                                    </div>
                                    <div class="col-10">
                                        <div class="form-group py-2 py-md-3" style="margin-left: 20px;">
                                            <label for="image">Prescription Image <span class="text-danger fs-4">*</span></label>
                                            <input type="file" class="form-control" name="image" id="image" onchange="document.querySelector('.img').src = window.URL.createObjectURL(this.files[0])">
                                            <span class="error-image error text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group py-2 py-md-3">
                                    <button type="submit" class="btn btn-outline-success">Send Prescription</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <ul>
                        @foreach($data as $item)
                        <li>{{$item->name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection
@push("js")
 <script>
    function addPathology(event){
        event.preventDefault();
        var formdata = new FormData(event.target)
        $.ajax({
            url: location.origin+"/send-prescription",
            method: "POST",
            data: formdata,
            contentType: false,
            processData: false,
            beforeSend: () => {
                $(".error").text("");
            },
            success: res => {
                if(res.error){
                    $.each(res.error, (index, value) => {
                        $(".error-"+index).text(value)
                    })
                }else{
                   $.notify(res, "success")
                   $(".img").prop("src", location.origin+"/noimage.jpg")
                }
            }
        })
    }
 </script>
@endpush