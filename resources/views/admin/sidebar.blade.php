<nav id="sidebar">
            <!-- Sidebar Header-->
            <div class="sidebar-header d-flex align-items-center">
                <div class="avatar"><img src="{{ asset('adminassets/img/avatar-6.jpg') }}" alt="..." class="img-fluid rounded-circle"></div>
                <div class="title">
                    <h1 class="h5"><span>Mark Stephen</span></h1>
                    <p>Web Designer</p>
                </div>
            </div>
            <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
            <ul class="list-unstyled">
                <li class="active"><a href="{{ route('dashboard') }}"> <i class="icon-home"></i><span>DashBoard</span></a></li>
                <li><a href="{{ route('posts.index') }}"> <i class="icon-grid"></i><span>Posts</span></a></li>
                <li><a href="{{ route('contactus.index') }}"> <i class="icon-padnote"></i> <span>Forms</span> </a></li>
                <li><a href="/"> <i class="icon-website"></i><span>View Website</span></a></li>
                <li><a href="charts.html"> <i class="fa fa-bar-chart"></i><span>Charts</span></a></li>
                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i><span>Example Dropdown</span></a>
                    <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                        <li><a href="#"><span>page</span></a></li>
                        <li><a href="#"><span>page</span></a></li>
                        <li><a href="#"><span>page</span></a></li>
                    </ul>
                </li>
                <li><a href="login.html"> <i class="icon-logout"></i><span>Login Page</span></a></li>
            </ul><span class="heading"><span>Extras</span></span>
            <ul class="list-unstyled">
                <li> <a href="#"> <i class="icon-settings"></i><span>Demo</span></a></li>
                <li> <a href="#"> <i class="icon-writing-whiteboard"></i><span>Demo</span></a></li>
                <li> <a href="#"> <i class="icon-chart"></i><span>Demo</span></a></li>
            </ul>
        </nav>