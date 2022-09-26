@extends("layouts.master")

@push("style")
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    /* Full-width input fields */
    #id01 #email, #id01 #password {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    /* Set a style for all buttons */
    .button {
        background-color: #04AA6D;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    .button:hover {
        opacity: 0.8;
    }

    /* Extra styles for the cancel button */
    .cancelbtn {
        width: auto;
        padding: 10px 18px;
        background-color: #f44336;
    }

    /* Center the image and position the close button */
    .imgcontainer {
        text-align: center;
        margin: 0 0 12px 0;
        position: relative;
    }

    img.avatar {
        width: 10%;
        border-radius: 50%;
    }

    .container {
        padding: 16px;
    }

    span.psw {
        float: right;
        padding-top: 16px;
    }
</style>
@endpush

@section("content")

<div id="id01" style="padding: 55px 0; padding-top:30px;">

    <div class="container">
        @if(Session::has("errors"))
            <p class="alert alert-danger">{{Session::get("errors")}}</p>
        @endif
    </div>

    <form action="{{route('user.login')}}" method="POST">
        @csrf
        <div class="imgcontainer">
            <img src="{{asset('frontend/img_avatar2.png')}}" alt="Avatar" width="100" class="avatar">
        </div>

        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-6">
                    <div class="form-gorup">
                        <label for="username"><b>Username</b></label>
                        <input type="text" placeholder="Enter username" name="email" id="email" value="{{old('email')}}" required>
                    </div>

                    <div class="form-group">
                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" id="password" name="password" value="{{old('password')}}" required>
                    </div>
                    <button class="button" type="submit">Login</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection