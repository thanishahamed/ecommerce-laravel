<div>
    <!-- mobile menu -->
    <div class="mercado-clone-wrap">
        <div class="mercado-panels-actions-wrap">
            <a class="mercado-close-btn mercado-close-panels" href="#">x</a>
        </div>
        <div class="mercado-panels"></div>
    </div>

    <!--header-->
    <header id="header" class="header header-style-1">
        <div class="container-fluid">
            <div class="row">
                <div class="topbar-menu-area">
                    <div class="container-fluid">
                        <div class="topbar-menu left-menu">
                            <ul>
                                <li class="menu-item">
                                    <a title="Hotline: +94 777277234" href="#"><span class="icon label-before fa fa-mobile"></span>Hotline: +94 777277234</a>
                                </li>
                            </ul>
                        </div>
                        <div class="topbar-menu right-menu">
                            <ul>
                                <!-- Authentication Links -->
                                @guest
                                @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @endif

                                @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                                @endif
                                @else
                                <li class="nav-item dropdown">
                                    <a href="#" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>

                                @if(auth()->user()->role === "admin")
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{route('admin')}}">
                                        {{ __('Admin') }}
                                    </a>
                                </li>
                                @endif
                                @endguest
                            </ul>
                        </div>
                    </div>
                    <div class="container">
                        <div class="mid-section main-info-area">

                            <div class="wrap-logo-top left-section">
                                <a href="{{route('home')}}" class="link-to-home"><img src="{{asset('assets/images/logo-top-1.png')}}" alt="mercado"></a>
                            </div>

                            <div class="wrap-search center-section">
                                <div class="wrap-search-form">
                                    <!-- <form action="{{route('search',$searchString)}}" id="form-search-top" name="form-search-top" onclick="preventDefault()"> -->
                                    <input type="text" name="search" wire:model="searchString" wire:keydown.enter="search" placeholder="Search here...">
                                    <button wire:click="search" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    <div class="wrap-list-cate">
                                        <input type="hidden" name="product-cate" value="0" id="product-cate">
                                        <a href="#" class="link-control">All Category</a>
                                        <ul class="list-cate">
                                            <li class="level-0">All Category</li>
                                            <li class="level-1">-Electronics</li>
                                            <li class="level-2">Batteries & Chargens</li>
                                            <li class="level-2">Headphone & Headsets</li>
                                            <li class="level-2">Mp3 Player & Acessories</li>
                                            <li class="level-1">-Smartphone & Table</li>
                                            <li class="level-2">Batteries & Chargens</li>
                                            <li class="level-2">Mp3 Player & Headphones</li>
                                            <li class="level-2">Table & Accessories</li>
                                            <li class="level-1">-Electronics</li>
                                            <li class="level-2">Batteries & Chargens</li>
                                            <li class="level-2">Headphone & Headsets</li>
                                            <li class="level-2">Mp3 Player & Acessories</li>
                                            <li class="level-1">-Smartphone & Table</li>
                                            <li class="level-2">Batteries & Chargens</li>
                                            <li class="level-2">Mp3 Player & Headphones</li>
                                            <li class="level-2">Table & Accessories</li>
                                        </ul>
                                    </div>
                                    <!-- </form> -->
                                </div>
                            </div>
                            <div class="wrap-icon right-section">
                                <div class="wrap-icon-section wishlist">
                                    <a href="#" class="link-direction">
                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                        <div class="left-info">
                                            <span class="index">0 item</span>
                                            <span class="title">Wishlist</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="wrap-icon-section minicart">
                                    <a href="{{route('cart')}}" class="link-direction">
                                        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                        <div class="left-info">

                                            @if($cartCount > 0)
                                            <span class="index"> {{$cartCount}} item(s)</span>
                                            @endif
                                            <span class="title">CART</span>
                                            <div wire:loading.delay wire:target="search" class="loading">Loading&#8230;</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="wrap-icon-section show-up-after-1024">
                                    <a href="#" class="mobile-navigation">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="nav-section header-sticky">
                        <div class="primary-nav-section">
                            <div class="container">
                                <ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu">
                                    <li class="menu-item home-icon">
                                        <a href="{{route('home')}}" class="link-term mercado-item-title"><i class="fa fa-home" aria-hidden="true"></i></a>
                                    </li>

                                    <li class="menu-item">
                                        <a href="{{route('shop')}}" class="link-term mercado-item-title">Shop</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{route('cart')}}" class="link-term mercado-item-title">Cart</a>
                                    </li>
                                    <!-- <li class="menu-item">
                                        <a href="{{route('checkout')}}" class="link-term mercado-item-title">Checkout</a>
                                    </li> -->
                                    <li class="menu-item">
                                        <a href="{{route('contact-us')}}" class="link-term mercado-item-title">Contact Us</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{route('about-us')}}" class="link-term mercado-item-title">About Us</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>