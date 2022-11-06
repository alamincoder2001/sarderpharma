<div class="page-sidebar">
    <a class="logo-box d-flex align-items-center" href="{{route('ambulance.dashboard')}}" style="padding:10px 10px 10px 10px !important;">
        <img src="{{asset($setting->logo)}}" alt="{{$setting->name}}" width="80%">
    </a>
    <div class="page-sidebar-inner">
        <div class="page-sidebar-menu">
            <ul class="accordion-menu">
                <li class="{{Route::is('ambulance.dashboard')?'active-page':''}}">
                    <a href="{{url('ambulance/dashboard')}}">
                        <i class="menu-icon fas fa-ambulance"></i><span>Ambulance Dashboard</span>
                    </a>
                </li>
                <li class="{{Route::is('ambulance.hire.ambulance')?'active-page':''}}">
                    <a href="{{route('ambulance.hire.ambulance')}}">
                        <i class="menu-icon fas fa-user"></i><span>Hire Ambulance Person</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>