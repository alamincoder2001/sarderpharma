<div class="page-sidebar">
    <a class="logo-box" href="{{route('ambulance.dashboard')}}">
        <span>{{$setting->name}}</span>
        <i class="icon-radio_button_unchecked" id="fixed-sidebar-toggle-button"></i>
        <i class="icon-close" id="sidebar-toggle-button-close"></i>
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