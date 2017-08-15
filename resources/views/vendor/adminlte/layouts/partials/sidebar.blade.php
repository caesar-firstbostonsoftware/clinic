<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview active"><a href="/NFHSI"><i class="fa fa-users"></i> <span>Patients</span><span class="pull-right-container"></span></a>
                <ul style="display: block;" class="treeview-menu menu-open">
                    <li><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
                    <li class="active"><a href="/NFHSI"><i class="fa fa-circle-o"></i> Patient List</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Create Medical Certificate</a></li>
                </ul>
            </li>
            @if(Session::get('user') == 1)
            <li><a href="/NFHSI/users"><i class="fa fa-user-md"></i> <span>Users</span></a></li>
            @endif
            <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>Sign out</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
