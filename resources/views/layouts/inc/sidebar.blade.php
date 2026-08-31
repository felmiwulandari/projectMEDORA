<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">MEDORA</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Nav Item - Specialist -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.specialist.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Specialist</span></a>
            </li>

            <!-- Nav Item - Doctor -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.doctor.index') }}">
                    <i class="fas fa-fw fa-check"></i>
                    <span>Doctor</span></a>
            </li>

            <!-- Nav Item - Schedule -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.schedule.index') }}">
                    <i class="fas fa-fw fa-check"></i>
                    <span>Schedule</span></a>
            </li>

            <!-- Nav Item - Patient -->
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-check"></i>
                    <span>Patient</span></a>
            </li>

            <!-- Nav Item - Registration -->
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-check"></i>
                    <span>Registration</span></a>
            </li>

            <!-- Nav Item - Admin -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.admin.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Admin</span></a>
            </li>
</ul>