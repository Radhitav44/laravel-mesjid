<!DOCTYPE html>
<html lang="en">

    @include('layouts.head')
    @yield('style')

    <body class="sidebar-noneoverflow" data-spy="scroll" data-target="#navSection" data-offset="100">
        @include('layouts.loader')
        @include('layouts.navbar')
        <div class="main-container" id="container">

            <div class="overlay"></div>
            <div class="search-overlay"></div>

            <!--  BEGIN CONTENT AREA  -->
            <div id="content" class="main-content">
                <div class="layout-px-spacing">

                    <div class="page-header">
                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <div class="title" style="margin-right: 0; border-right: none; padding-right: 0;">
                                <h3>@yield('header-title', 'Page')</h3>
                            </div>
                        </nav>
                        @yield('header-right')
                    </div>
                    <div class="row layout-top-spacing">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
                            @yield('content')
                        </div>
                    </div>
                </div>
                @include('layouts.footer')
            </div>
            <!--  END CONTENT AREA  -->


        </div>
        @include('layouts.body')
        @yield('script')
    </body>

</html>
