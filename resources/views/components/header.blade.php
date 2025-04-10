@guest
    <header class="d-flex justify-content-between align-items-center position-absolute z-1 w-100 py-4 px-3">
        <h1 class="text-white fw-semibold mb-0">Mission Todo</h1>
            <div>
                <a href="{{ route('login') }}" class="text-black-700 dark:text-black-500 underline me-3">ログイン</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-black-700 dark:text-black-500 underline ms-2">会員登録</a>
                @endif
            </div>
    </header>
@endguest

@auth
    <nav class="navbar navbar-success  bg-success d-flex justify-content-between align-items-center w-100 px-4 py-3">
        <a class="navbar-brand text-white fs-2" href="{{ route('tasks')}}">Mission Todo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
            <div class="offcanvas offcanvas-end bg-success" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title text-white" id="offcanvasDarkNavbarLabel">{{ Auth::user()->name }}さん</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('tasks')}}">タスク追加</a>
                        </li>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('lists') }}">リスト追加</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="{{ route('tasks',['deadline' => 'true']) }}">日付指定あり</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('tasks',['list_id' => 'true']) }}">リスト別</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('tasks',['checked' => 'true']) }}">実行済み</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('tasks',['checked' => 'false']) }}">未実行</a>
                        </li>
                        <li class="nav-item mt-2">
                            <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                        this.closest('form').submit();" class="text-white">
                                        {{ __('ログアウト') }}
                            </x-responsive-nav-link>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
    </nav>
@endauth

