<div class="flex-fill">
<ul class="list-unstyled ml-auto d-flex justify-content-end m-0 top-right-nav">

    <!-- Authentication Links -->
    @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('auth.Login') }}</a>
        </li>
        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('register.Register') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                @if(Auth::user()->isAdmin())
                    <a class="dropdown-item text-danger" href="{{ route('admin.home') }}" target="_blank">{{ __('menu.Admin') }}</a>
                @endif

                <a class="dropdown-item" href="#" target="_blank">{{ __('menu.Cabinet') }}</a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
    <li class="nav-item cart-mini"><a class="nav-link" href="{{ route('cart.index') }}">
            <div class="cart-mini-block">
                <i class="fal fa-shopping-cart">
                    <span>{{ $countCart }}</span>
                </i>
                <div>Корзина</div>
            </div>
        </a>
    </li>
</ul>
</div>
