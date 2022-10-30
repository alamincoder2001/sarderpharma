<section class="top-header">
    <div class="container">
        <div class="row d-flex align-item-center">
            <div class="col-md-6 col-4">
                <p>Address: Mirpur-10, Dhaka</p>
            </div>
            <div class="col-md-6 col-8">
                <p class="text-end"><span>Opening Hours:</span> Monday to Saturday - 8am to 10pm, <span>Contact: </span> +880 1737 484046</p>
            </div>
        </div>
    </div>
</section>


<nav class="navbar navbar-expand-lg sticky-top min-high">
    <div class="container p-0">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{asset($setting->logo)}}" width="100" style="min-width: 230px;" />
            <!-- <img src="{{asset($setting->logo)}}" width="100" style="min-width: 230px;" /> -->
        </a>
        <button style="outline: 0;box-shadow: none;background: #fff;" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto text-center mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-uppercase {{Route::is('website')?'activ':''}}" href="{{url('/')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase {{Route::is('doctor.details')?'activ':''}}" href="{{route('doctor.details')}}">Doctors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase {{Route::is('hospital.details')?'activ':''}}" href="{{route('hospital.details')}}">Hospital</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase {{Route::is('diagnostic.details')?'activ':''}}" href="{{route('diagnostic.details')}}">Diagnostic</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase {{Route::is('ambulance.details')?'activ':''}}" href="{{route('ambulance.details')}}">Ambulance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase {{Route::is('donor')?'activ':''}}" href="{{route('donor')}}">Blood Donor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase {{Route::is('aboutus')?'activ':''}}" href="{{route('aboutus')}}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase {{Route::is('contactus')?'activ':''}}" href="{{route('contactus')}}">Contact Us</a>
                </li>
            </ul>
        </div>
        <div id="google_translate_element" style="margin-left: 8px;"></div>
    </div>
</nav>