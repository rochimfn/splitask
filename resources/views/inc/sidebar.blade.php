            <hr>
            <br>
            <h3 class="d-flex justify-content-center">Account Information</h3>
            <br>
            <img src="https://api.adorable.io/avatars/128/abott@adorable.png" class="rounded-circle mx-auto d-block border-right" alt="">
            <br>
            <br>
            <p class="d-flex justify-content-center">{{ Auth::user()->name }}</p>
            <p class="d-flex justify-content-center">{{ Auth::user()->user_name }}</p>
            <p class="d-flex justify-content-center">{{ Auth::user()->email }}</p>
            <p class="d-flex justify-content-center">{{ ucfirst(Auth::user()->position) }}</p>
            <hr>
            <a href="{{ route('users.edit') }}" class="d-flex justify-content-center">Account Setting</a>
            <a href="" class="d-flex justify-content-center" onclick="document.getElementById('logout-form').submit()">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="post">
                @csrf
            </form>
            <hr>
