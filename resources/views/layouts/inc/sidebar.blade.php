<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-hospital"></i>
                </div>
                <div class="sidebar-brand-text mx-3">MEDORA</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Nav Item - Patient -->
            <li class="nav-item {{ request()->routeIs('admin.patient.*') ? 'active' : '' }}">
                <a class="nav-link" href="#">
                    <i class="fas fa-hospital-user"></i>
                    <span>Patient</span></a>
            </li>

            <!-- Nav Item - Doctor -->
            <li class="nav-item {{ request()->routeIs('admin.doctor.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.doctor.index') }}">
                    <i class="fas fa-user-md"></i>
                    <span>Doctor</span></a>
            </li>

             <!-- Nav Item - Specialist -->
            <li class="nav-item {{ request()->routeIs('admin.specialist.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.specialist.index') }}">
                    <i class="fas fa-stethoscope"></i>
                    <span>Specialist</span></a>
            </li>

            <!-- Nav Item - Schedule -->
            <li class="nav-item {{ request()->routeIs('admin.schedule.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.schedule.index') }}">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Schedule</span></a>
            </li>  

            <!-- Nav Item - Registration -->
            <li class="nav-item {{ request()->routeIs('admin.registration.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.registration.index') }}">
                    <i class="fas fa-notes-medical"></i>
                    <span>Registration</span></a>
            </li>

            <!-- Nav Item - Admin -->
            <li class="nav-item {{ request()->routeIs('admin.admin.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.admin.index') }}">
                    <i class="fas fa-user-circle"></i>
                    <span>Admin</span></a>
            </li>
</ul>