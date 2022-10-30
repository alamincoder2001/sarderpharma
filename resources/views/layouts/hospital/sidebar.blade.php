<div class="page-sidebar">
    <a class="logo-box" href="{{route('hospital.dashboard')}}">
        <span>{{$setting->name}}</span>
        <i class="icon-radio_button_unchecked" id="fixed-sidebar-toggle-button"></i>
        <i class="icon-close" id="sidebar-toggle-button-close"></i>
    </a>
    <div class="page-sidebar-inner">
        <div class="page-sidebar-menu">
            <ul class="accordion-menu">
                <li class="{{Route::is('hospital.dashboard')?'active-page':''}}">
                    <a href="{{url('hospital/dashboard')}}">
                        <i class="menu-icon fas fa-hospital"></i><span>Hospital Dashboard</span>
                    </a>
                </li>
                <li class="{{Route::is('hospital.doctor.index')||Route::is('hospital.doctor.create')||Route::is('hospital.doctor.edit')?'active-page':''}}">
                    <a href="#!" class="{{Route::is('hospital.doctor.index')||Route::is('hospital.doctor.create')||Route::is('hospital.doctor.edit')?'active':''}}">
                        <i class="menu-icon fas fa-user-md"></i><span>Doctor</span><i class="accordion-icon fa fa-angle-left"></i>
                    </a>
                    <ul class="{{Route::is('hospital.doctor.index')||Route::is('hospital.doctor.create')||Route::is('hospital.doctor.edit')?'sub-menu':''}}">
                        <li class="{{Route::is('hospital.doctor.index')?'active':''}}"><a href="{{route('hospital.doctor.index')}}">Manage Doctor</a></li>
                        <li class="{{Route::is('hospital.doctor.create')||Route::is('hospital.doctor.edit')?'active':''}}"><a href="{{route('hospital.doctor.create')}}">Create Doctor</a></li>
                    </ul>
                </li>
                <li class="{{Route::is('hospital.appointment.index')?'active-page':''}}">
                    <a href="{{route('hospital.appointment.index')}}">
                        <i class="menu-icon fas fa-user-plus"></i><span>Patient List</span>
                    </a>
                </li>
                <li class="{{Route::is('hospital.test.index')?'active-page':''}}">
                    <a href="{{route('hospital.test.index')}}">
                        <i class="menu-icon fa fa-list-alt"></i><span>Test List</span>
                    </a>
                </li>
                <li class="{{Route::is('hospital.contact.index')?'active-page':''}}">
                    <a href="{{route('hospital.contact.index')}}">
                        <i class="menu-icon fa fa-question-circle"></i><span>Clients Question</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>