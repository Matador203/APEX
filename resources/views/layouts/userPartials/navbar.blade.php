<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
    

        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">
                
                <!-- Logo desktop -->		
                <a href="/home" class="logo">
                    {{-- <img src="{{asset('logo/POS.png')}}" alt="IMG-LOGO"> --}}
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="{{ request()->is('home') ? 'active-menu' : ''}}">
                            <a href="/home">Home</a>
                        </li>
                        @auth
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                  <a class="text-sm text-gray-700 dark:text-gray-500 underline" href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();" class="nav-link">
                                    <li></li>
                                    <p>
                                      Logout
                                    </p>
                                  </a>
                            </form>
                        </li>
                       
                    @else
                    <li>
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
                    </li>
                    <li>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    </li>
                       
                    @endauth

                    </ul>
                </div>
                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m m-r-15">
                    <a href="/cart">
                        <div class="icon-header-item cl2 hov-cl2 trans-04 p-r-11 p-l-10 " data-notify=""
                        >
                            <i href="#" class="zmdi zmdi-shopping-cart"></i>
                        </div>
                    </a>
                </div>
            </nav>
        </div>	
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->		
        <div class="logo-mobile">
            <a href="/home">
                <img src="{{asset('logo/POS.png')}}" alt="IMG-LOGO">
            </a>
        </div>

        <!-- Icon header -->
        <a href="/cart">
            <div class="wrap-icon-header flex-w flex-r-m m-r-15">
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 " data-notify="">
                    <i href="#" class="zmdi zmdi-shopping-cart"></i>
                </div>
    
                
            </div>
        </a>
        

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        

        <ul class="main-menu-m">
            <li class="{{ request()->is('/home') ? 'active-menu' : ''}}">
                <a href="home">Home</a>        
            </li>
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                        @csrf
                          <a class="text-sm text-gray-700 dark:text-gray-500 underline" href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                              Logout
                            </p>
                          </a>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            
            
        </ul>
    </div>
</header>
