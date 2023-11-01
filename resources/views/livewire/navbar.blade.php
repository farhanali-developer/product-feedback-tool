<div>
    <header>
        <nav class="flex flex-wrap items-center justify-between w-full py-4 md:py-0 px-4 text-lg text-gray-700 bg-white">
            <div>
                <a href="{{ route('home') }}">Product Feedback Tool</a>
            </div>
          
            <div class="hidden w-full md:flex md:items-center md:w-auto" id="menu">
                @if($user)
                <h6>Welcome {{ $user->name }}!</h6>
                <a class="md:p-4 py-2 block hover:text-purple-400 text-purple-500" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                <ul class="pt-4 text-base text-gray-700 md:flex md:justify-between md:pt-0">
                        <li><a class="md:p-4 py-2 block hover:text-purple-400 text-purple-500" href="{{ route('register') }}">Sign Up</a></li>
                        <li><a class="md:p-4 py-2 block hover:text-purple-400 text-purple-500" href="{{ route('login') }}">Login</a></li>
                    </ul>
                    @endif
            </div>
       </nav>
    </header>
</div>