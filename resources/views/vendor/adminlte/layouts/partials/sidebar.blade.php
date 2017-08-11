<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview active"><a href="#"><i class="fa fa-users"></i> <span>Patients</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul style="display: block;" class="treeview-menu menu-open">
                    <li><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
                    <li class="active"><a href="/"><i class="fa fa-circle-o"></i> Patient List</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Create Medical Certificate</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-user-md"></i> <span>Users</span></a></li>
            <li><a href="#"><i class="fa fa-cogs"></i> <span>Settings</span></a></li>
            <li><a href="#"><i class="fa fa-sign-out"></i> <span>Sign out</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
