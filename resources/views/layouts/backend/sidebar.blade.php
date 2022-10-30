<div class="page-sidebar">
    <a class="logo-box d-flex align-items-center" href="{{route('admin.dashboard')}}" style="padding:10px 10px 10px 10px !important;">
        <img src="{{asset($setting->logo)}}" alt="{{$setting->name}}" width="80%">
        <!-- <span>{{$setting->name}}</span> -->
        <!-- <i class="icon-radio_button_unchecked" id="fixed-sidebar-toggle-button"></i> -->
        <!-- <i class="icon-close" id="sidebar-toggle-button-close"></i> -->
    </a>
    <div class="page-sidebar-inner">
        <div class="page-sidebar-menu">
            <ul class="accordion-menu">
                <li class="{{Route::is('admin.dashboard')?'active-page':''}}">
                    <a href="{{url('admin/dashboard')}}">
                        <i class="menu-icon icon-home4"></i><span>Dashboard</span>
                    </a>
                </li>
                <li class="{{Route::is('admin.doctor.index')||Route::is('admin.doctor.create')||Route::is('admin.doctor.edit')?'active-page':''}}">
                    <a href="#!" class="{{Route::is('admin.doctor.index')||Route::is('admin.doctor.create')||Route::is('admin.doctor.edit')?'active':''}}">
                        <i class="menu-icon fas fa-user-md"></i><span>Doctor</span><i class="accordion-icon fa fa-angle-left"></i>
                    </a>
                    <ul class="{{Route::is('admin.doctor.index')||Route::is('admin.doctor.create')||Route::is('admin.doctor.edit')?'sub-menu':''}}">
                        <li class="{{Route::is('admin.doctor.index')?'active':''}}"><a href="{{route('admin.doctor.index')}}">Manage Doctor</a></li>
                        <li class="{{Route::is('admin.doctor.create')||Route::is('admin.doctor.edit')?'active':''}}"><a href="{{route('admin.doctor.create')}}">Create Doctor</a></li>
                    </ul>
                </li>
                <li class="{{Route::is('admin.hospital.index')||Route::is('admin.hospital.create')||Route::is('admin.hospital.edit')?'active-page':''}}">
                    <a href="#!" class="{{Route::is('admin.hospital.index')||Route::is('admin.hospital.create')||Route::is('admin.hospital.edit')?'active':''}}">
                        <i class="menu-icon fas fa-hospital"></i><span>Hopital</span><i class="accordion-icon fa fa-angle-left"></i>
                    </a>
                    <ul class="{{Route::is('admin.hospital.index')||Route::is('admin.hospital.create')||Route::is('admin.hospital.edit')?'sub-menu':''}}">
                        <li class="{{Route::is('admin.hospital.index')?'active':''}}"><a href="{{route('admin.hospital.index')}}">Manage Hospital</a></li>
                        <li class="{{Route::is('admin.hospital.create')||Route::is('admin.hospital.edit')?'active':''}}"><a href="{{route('admin.hospital.create')}}">Create Hospital</a></li>
                    </ul>
                </li>
                <li class="{{Route::is('admin.diagnostic.index')||Route::is('admin.diagnostic.create')||Route::is('admin.diagnostic.edit')?'active-page':''}}">
                    <a href="#!" class="{{Route::is('admin.diagnostic.index')||Route::is('admin.diagnostic.create')||Route::is('admin.diagnostic.edit')?'active':''}}">
                        <i class="menu-icon fa fa-plus-square"></i><span>Diagnostic</span><i class="accordion-icon fa fa-angle-left"></i>
                    </a>
                    <ul class="{{Route::is('admin.diagnostic.index')||Route::is('admin.diagnostic.create')||Route::is('admin.diagnostic.edit')?'sub-menu':''}}">
                        <li class="{{Route::is('admin.diagnostic.index')?'active':''}}"><a href="{{route('admin.diagnostic.index')}}">Manage Diagnostic</a></li>
                        <li class="{{Route::is('admin.diagnostic.create')||Route::is('admin.diagnostic.edit')?'active':''}}"><a href="{{route('admin.diagnostic.create')}}">Create Diagnostic</a></li>
                    </ul>
                </li>
                <li class="{{Route::is('admin.ambulance.index')||Route::is('admin.ambulance.create')||Route::is('admin.ambulance.edit')?'active-page':''}}">
                    <a href="#!" class="{{Route::is('admin.ambulance.index')||Route::is('admin.ambulance.create')||Route::is('admin.ambulance.edit')?'active':''}}">
                        <i class="menu-icon fa fa-ambulance"></i><span>Ambulance</span><i class="accordion-icon fa fa-angle-left"></i>
                    </a>
                    <ul class="{{Route::is('admin.ambulance.index')||Route::is('admin.ambulance.create')||Route::is('admin.ambulance.edit')?'sub-menu':''}}">
                        <li class="{{Route::is('admin.ambulance.index')?'active':''}}"><a href="{{route('admin.ambulance.index')}}">Manage Ambulance</a></li>
                        <li class="{{Route::is('admin.ambulance.create')||Route::is('admin.ambulance.edit')?'active':''}}"><a href="{{route('admin.ambulance.create')}}">Create Ambulance</a></li>
                    </ul>
                </li>
                <li class="{{Route::is('admin.privatecar.index')||Route::is('admin.privatecar.create')||Route::is('admin.privatecar.edit')?'active-page':''}}">
                    <a href="#!" class="{{Route::is('admin.privatecar.index')||Route::is('admin.privatecar.create')||Route::is('admin.privatecar.edit')?'active':''}}">
                        <i class="menu-icon fa fa-car"></i><span>Privatecar</span><i class="accordion-icon fa fa-angle-left"></i>
                    </a>
                    <ul class="{{Route::is('admin.privatecar.index')||Route::is('admin.privatecar.create')||Route::is('admin.privatecar.edit')?'sub-menu':''}}">
                        <li class="{{Route::is('admin.privatecar.index')?'active':''}}"><a href="{{route('admin.privatecar.index')}}">Manage Privatecar</a></li>
                        <li class="{{Route::is('admin.privatecar.create')||Route::is('admin.privatecar.edit')?'active':''}}"><a href="{{route('admin.privatecar.create')}}">Create Privatecar</a></li>
                    </ul>
                </li>
                <li class="{{Route::is('department.index')?'active-page':''}}">
                    <a href="{{route('department.index')}}">
                        <i class="menu-icon fa fa-list-alt"></i><span>Department List</span>
                    </a>
                </li>
                <li class="{{Route::is('test.index')?'active-page':''}}">
                    <a href="{{route('test.index')}}">
                        <i class="menu-icon fa fa-list-alt"></i><span>Test List</span>
                    </a>
                </li>
                <li class="{{Route::is('admin.blood.donor')?'active-page':''}}">
                    <a href="{{route('admin.blood.donor')}}" class="d-flex align-items-center">
                        <img src="{{asset('donor.png')}}" width="18" class="menu-icon"><span style="padding-top: 5px;padding-left: 8px;">Blood Donor</span>
                    </a>
                </li>
                <li class="{{Route::is('slider.index')?'active-page':''}}">
                    <a href="{{route('slider.index')}}">
                        <i class="menu-icon fa fa-list-alt"></i><span>Slider</span>
                    </a>
                </li>
                <li class="{{Route::is('partner.index')?'active-page':''}}">
                    <a href="{{route('partner.index')}}">
                        <i class="menu-icon fas fa-handshake"></i><span>Corporate Partner</span>
                    </a>
                </li>
                <li class="{{Route::is('admin.contact.index')?'active-page':''}}">
                    <a href="{{route('admin.contact.index')}}">
                        <i class="menu-icon fa fa-phone-square"></i><span>Contact Page Setting</span>
                    </a>
                </li>
                <li class="{{Route::is('admin.contactcompany.index')?'active-page':''}}">
                    <a href="{{route('admin.contactcompany.index')}}">
                        <i class="menu-icon fa fa-question-circle"></i><span>Clients Question</span>
                    </a>
                </li>
                <li class="menu-divider"></li>
                <li class="{{Route::is('setting.index')?'active-page':''}}">
                    <a href="{{route('setting.index')}}">
                        <i class="menu-icon fas fa-cog"></i><span>Setting</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>