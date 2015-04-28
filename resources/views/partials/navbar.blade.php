<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="btn btn-primary pull-right visible-xs" data-toggle="collapse" data-target="#navbar-collapse-1" style="margin:8px 15px 0 0">
                <i class="fa fa-navicon"></i>
            </button>
            <a class="navbar-brand" href="#">Soton <i class="fa fa-book"></i> Shop</a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('pages.home') }}">Home</a></li>
                <li><a href="{{ route('books.index') }}">Books</a></li>
                <li><a href="{{ route('subjects.index') }}">Subjects</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/auth/login') }}">Login</a></li>
                    <li><a href="{{ url('/auth/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->first_name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('users.show', Auth::user()->username) }}">Account</a></li>
                            <li><a href="{{ route('users.books.index', Auth::user()->username) }}">Books</a></li>
                            <li><a href="{{ route('users.orders.index', Auth::user()->username) }}">Orders</a></li>
                            <li><a href="{{ route('users.show', Auth::user()->username) }}/wishlist">Wishlist</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>