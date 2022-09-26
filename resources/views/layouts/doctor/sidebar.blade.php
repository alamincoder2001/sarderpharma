<div class="page-sidebar">
    <a class="logo-box" href="{{url('doctor/dashboard')}}">
        <span>{{$setting->name}}</span>
        <i class="icon-radio_button_unchecked" id="fixed-sidebar-toggle-button"></i>
        <i class="icon-close" id="sidebar-toggle-button-close"></i>
    </a>
    <div class="page-sidebar-inner">
        <div class="page-sidebar-menu">
            <ul class="accordion-menu">
                <li class="{{Route::is('doctor.dashboard')?'active-page':''}}">
                    <a href="{{url('doctor/dashboard')}}">
                        <i class="menu-icon fas fa-user-md"></i><span>Doctor Dashboard</span>
                    </a>
                </li>
                <li class="{{Route::is('doctor.appointment')?'active-page':''}}">
                    <a href="{{route('doctor.appointment')}}">
                        <i class="menu-icon fa fa-user-plus"></i><span>Patient List</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>