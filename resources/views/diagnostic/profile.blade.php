@extends("layouts.diagnostic.app")
@section("title", "Diagnostic Profile")
@push("style")
<style>
    .diagnostic-card-heading {
        background-position: center !important;
        background-size: 100% 100% !important;
        background-repeat: no-repeat !important;
        height: 300px !important;
    }
</style>
@endpush
@section("content")
<div class="row d-flex justify-content-center">
    <!-- Column -->
    <div class="col-md-8 col-lg-10 col-xlg-3">
        <div class="card card-hover">
            <div class="card-heading diagnostic-card-heading" style="background: url('{{asset(Auth::guard('diagnostic')->user()->image)}}');"></div>
            <div class="box bg-success text-center py-3">
                <h6 class="text-white">Diagnostic Profile</h6>
            </div>
            <div class="card-body pt-3">
                <form id="updateDiagnostic">
                    <input type="hidden" name="id" id="id" value="{{Auth::guard('diagnostic')->user()->id}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Diagnostic Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{Auth::guard('diagnostic')->user()->name}}">
                                <span class="error-name error text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" value="{{Auth::guard('diagnostic')->user()->username}}">
                                <span class="error-username error text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Diagnostic Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{Auth::guard('diagnostic')->user()->email}}">
                                <span class="error-email error text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Diagnostic Phone</label>
                                <div class="input-group">
                                    <i class="btn btn-secondary">+88</i><input type="text" name="phone" id="phone" class="form-control" value="{{Auth::guard('diagnostic')->user()->phone}}">
                                </div>
                                <span class="error-phone error text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="diagnostic_type">Diagnostic Type</label>
                                <select name="diagnostic_type" id="diagnostic_type" class="form-control">
                                    <option value="">Select Diagnostic Type</option>
                                    <option value="government" {{Auth::guard('diagnostic')->user()->diagnostic_type=="government"?"selected":""}}>Government</option>
                                    <option value="non-government" {{Auth::guard('diagnostic')->user()->diagnostic_type=="non-government"?"selected":""}}>Non-Government</option>
                                </select>
                                <span class="error-diagnostic_type error text-danger"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city_id">City</label>
                                <select name="city_id" id="city_id" class="form-control select2">
                                    <option value="">Select City</option>
                                    @foreach($cities as $city)
                                    <option value="{{$city->id}}" {{Auth::guard('diagnostic')->user()->city_id==$city->id?"selected":""}}>{{$city->name}}</option>
                                    @endforeach
                                </select>
                                <span class="error-city_id error text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" id="address" class="form-control">{{Auth::guard('diagnostic')->user()->address}}</textarea>
                                <span class="error-address error text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="map_link">Map Link</label>
                                <textarea name="map_link" id="map_link" class="form-control">{{Auth::guard('diagnostic')->user()->map_link}}</textarea>
                                <span class="error-map_link error text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-gorup text-center">
                        <button type="submit" class="btn btn-primary px-3">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push("js")
<script>
    $(document).ready(() => {
        $("#updateDiagnostic").on("submit", (event) => {
            event.preventDefault()
            var formdata = new FormData(event.target)
            $.ajax({
                url: "{{route('diagnostic.profile.update')}}",
                data: formdata,
                method: "POST",
                dataType: "JSON",
                contentType: false,
                processData: false,
                beforeSend: () => {
                    $("#updateDiagnostic").find(".error").text("");
                },
                success: (response) => {
                    if (response.error) {
                        $.each(response.error, (index, value) => {
                            $("#updateDiagnostic").find(".error-" + index).text(value);
                        })
                    } else {
                        $.notify(response, "success");
                    }
                }
            })
        })
    })
</script>
@endpush