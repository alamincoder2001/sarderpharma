<div class="page-sidebar">
    <a class="logo-box d-flex align-items-center" href="{{route('diagnostic.dashboard')}}" style="padding:10px 10px 10px 10px !important;">
        <img src="{{asset($setting->logo)}}" alt="{{$setting->name}}" width="80%">
    </a>
    <div class="page-sidebar-inner">
        <div class="page-sidebar-menu">
            <ul class="accordion-menu">
                <li class="{{Route::is('diagnostic.dashboard')?'active-page':''}}">
                    <a href="{{url('diagnostic/dashboard')}}">
                        <i class="menu-icon fas fa-plus-square"></i><span>Diagnostic Dashboard</span>
                    </a>
                </li>
                <li class="{{Route::is('diagnostic.doctor.index')||Route::is('diagnostic.doctor.create')||Route::is('diagnostic.doctor.edit')?'active-page':''}}">
                    <a href="#!" class="{{Route::is('diagnostic.doctor.index')||Route::is('diagnostic.doctor.create')||Route::is('diagnostic.doctor.edit')?'active':''}}">
                        <i class="menu-icon fas fa-user-md"></i><span>Doctor</span><i class="accordion-icon fa fa-angle-left"></i>
                    </a>
                    <ul class="{{Route::is('diagnostic.doctor.index')||Route::is('diagnostic.doctor.create')||Route::is('diagnostic.doctor.edit')?'sub-menu':''}}">
                        <li class="{{Route::is('diagnostic.doctor.index')?'active':''}}"><a href="{{route('diagnostic.doctor.index')}}">Manage Doctor</a></li>
                        <li class="{{Route::is('diagnostic.doctor.create')||Route::is('diagnostic.doctor.edit')?'active':''}}"><a href="{{route('diagnostic.doctor.create')}}">Create Doctor</a></li>
                    </ul>
                </li>
                <li class="{{Route::is('diagnostic.appointment')?'active-page':''}}">
                    <a href="{{route('diagnostic.appointment')}}">
                        <i class="menu-icon fas fa-user-plus"></i><span>Patient List</span>
                    </a>
                </li>
                <li class="{{Route::is('diagnostic.test.index')?'active-page':''}}">
                    <a href="{{route('diagnostic.test.index')}}">
                        <i class="menu-icon fa fa-list-alt"></i><span>Test List</span>
                    </a>
                </li>
                <li class="{{Route::is('diagnostic.contact.index')?'active-page':''}}">
                    <a href="{{route('diagnostic.contact.index')}}">
                        <i class="menu-icon fa fa-question-circle"></i><span>Clients Question</span>
                    </a>
                </li>
            </ul> 
        </div>
    </div>
</div>