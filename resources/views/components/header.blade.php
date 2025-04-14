<header class="d-flex justify-content-between align-items-center position-absolute z-1 w-100 py-4 px-3">
    <h1 class="text-white fw-semibold mb-0">Mission Todo</h1>
        <div>
            <a href="{{ route('login') }}" class="text-black-700 dark:text-black-500 underline me-3">ログイン</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="text-black-700 dark:text-black-500 underline ms-2">会員登録</a>
            @endif
        </div>
</header>
