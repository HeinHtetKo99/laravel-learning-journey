<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <!-- starter -->
            <div class="nav">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#starter" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    starter
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="starter" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{url('/admin/page1')}}">Page1</a>
                        <a class="nav-link" href="{{url('/admin/page2')}}">Page2</a>
                        <a class="nav-link" href="{{url('/admin/page3')}}">Page3</a>
                        <a class="nav-link" href="{{url('/admin/page4')}}">Page4</a>
                        <a class="nav-link" href="{{url('/admin/page5')}}">Page5</a>
                    </nav>
                </div>
            </div>

            <!-- routing -->
            <div class="nav">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#routing" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Routing
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="routing" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{url('/admin/routing/view-only')}}">View Only</a>
                        <a class="nav-link" href="{{url('/admin/routing/passing-data-to-view')}}">Passing Data To View</a>
                        <a class="nav-link" href="{{url('/admin/routing/route-parameter/dodgerBlue/white')}}">Route Parameter</a>
                        <a class="nav-link" href="{{url('/admin/routing/dynamic-route-parameter')}}">Dynamic Route Parameter</a>
                        <a class="nav-link" href="{{url('/admin/routing/named-route')}}">Named Route</a>
                        <a class="nav-link" href="{{url('/admin/routing/middleware')}}">Middleware</a>
                    </nav>
                </div>

            </div>

            <!-- csrf -->
            <div class="nav">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#csrf" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    CSRF
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="csrf" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{url('/admin/csrf/lecture1')}}">Lecture1</a>
                        <a class="nav-link" href="{{url('/admin/csrf/lecture2')}}">Lecture2</a>
                        <a class="nav-link" href="{{url('/admin/csrf/lecture3')}}">Lecture3</a>
                    </nav>
                </div>                
            </div>

            <!-- session -->
            <div class="nav">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#session" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Session
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="session" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{url('/admin/session/lecture')}}">Lecture</a>
                        <a class="nav-link" href="{{url('/admin/session/tasks')}}">Tasks</a>
                    </nav>
                </div>                
            </div>

            <!-- blade template -->
            <div class="nav">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#blade-template" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Blade Template
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="blade-template" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{url('/admin/blade-template/component')}}">Component</a>
                        <a class="nav-link" href="{{url('/admin/blade-template/localization')}}">Localization</a>
                    </nav>
                </div>                
            </div>

            <!-- users management -->
             <div class="nav">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#user-management" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    User management
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="user-management" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{url('/admin/users')}}">Users</a>
                    </nav>
                </div>                
            </div>

             <!-- orders management -->
             <div class="nav">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#order-management" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Order management
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="order-management" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{url('/admin/brands')}}">Brands</a>
                        <a class="nav-link" href="{{url('/admin/categories')}}">categories</a>
                        <a class="nav-link" href="{{url('/admin/items')}}">Items</a>
                        <a class="nav-link" href="{{url('/admin/orders')}}">Orders</a>
                    </nav>
                </div>                  
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>