@extends("layouts.app")
@section("title", "Admin- Setting page")

@section("content")

<div class="row d-flex justify-content-center align-items-center">
    <div class="col-md-7">
        <div class="card" style="padding: 50px !important">
            <div class="card-body">
                <h4 class="text-center">Setting Save & Update</h4>
                <hr>
                <form id="submitSetting">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-3">
                            <label for="name">Company Name</label>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" id="name">
                                <span class="error-name text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex align-items-center pb-2">
                        <div class="col-md-3">
                            <div class="image" style="width: 100px;height:100px;border:1px solid gray;overflow:hidden;">
                                <img class="fav-img" width="120" height="100" />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="favicon">FavIcon</label>
                                <input type="file" class="form-control" name="favicon" id="favicon" onchange="document.querySelector('.fav-img').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center pb-2">
                        <div class="col-md-3">
                            <div class="image" style="width: 100px;height:100px;border:1px solid gray;overflow:hidden;">
                                <img class="logo-img" width="120" height="100" />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <input type="file" class="form-control" name="logo" id="logo" onchange="document.querySelector('.logo-img').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-success text-white text-uppercase">Setting Change</button>
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

        function getData() {
            $.ajax({
                url: "{{route('setting.get')}}",
                method: "GET",
                dataType: "JSON",
                success: (response) => {
                    $("#submitSetting").find("#name").val(response.name)
                    $("#submitSetting").find(".fav-img").attr("src", window.location.protocol + '//' + window.location.host + '/' + response.favicon)
                    $("#submitSetting").find(".logo-img").attr("src", window.location.protocol + '//' + window.location.host + '/' + response.logo)
                }
            })
        }
        getData();

        $("#submitSetting").on("submit", (event) => {
            event.preventDefault()

            var formdata = new FormData(event.target);
            // console.log(event);
            $.ajax({
                url: "{{route('setting.store')}}",
                method: "POST",
                dataType: "JSON",
                data: formdata,
                contentType: false,
                processData: false,
                cache: false,
                beforeSend: () => {
                    $("#submitSetting").find("span").text("");
                },
                success: (response) => {
                    if (response.error) {
                        $.each(response.error, (index, value) => {
                            $("#submitSetting").find(".error-" + index).text(value);
                        })
                    } else {
                        getData();
                        $("#submitSetting").trigger('reset')
                        $.notify(response, "success");
                    }
                }
            })
        })
    })
</script>
@endpush