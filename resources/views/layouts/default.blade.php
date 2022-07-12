<!DOCTYPE html>
<html>

<head>
    @include('includes.head')
</head>

<body>
    @if (Auth::check())
    <div>
        <header>
            @include('includes.header')
        </header>
        
        <div id="sidebar"> 
            @include('includes.sidebar')
        </div>
        
        <div id="main">
            <button class="siebar_toggle">
                <i class="fa fa-chevron-left sb_left" aria-hidden="true"></i>
                <i class="fa fa-chevron-right sb_right" aria-hidden="true"></i>
            </button>
            @yield('content')
        </div>

        <footer class="">
            @include('includes.footer')
        </footer>
        
    </div>
    
    
    
    @endif
</body>
</html>