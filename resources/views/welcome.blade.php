<x-main>

    <x-slot name="header">
        <x-header>
        </x-header>
    </x-slot>

    <div class="vh-100 d-flex">

        <div class="w-50 bg-success d-flex flex-column align-items-center justify-content-center position-relative">

            <div class="text-center">
                <img src="{{ asset('storage/img/personal-goals-checklist-amico.png') }}" class="img-fluid w-75">
                    <h3 class="text-white">日々のタスクをMission Todoで管理しよう</h3>
                        <h5 class="text-white pt-2">操作が簡単だから継続化しやすい</h5>
            </div>
            <div class="position-absolute bottom-0 start-50 translate-middle-x py-4 px-3">
                <a class="text-white opacity-25" style="font-size: 0.75rem;" href="https://storyset.com/people">People illustrations by Storyset</a>
            </div>
        </div>

        <div class="w-50 d-flex flex-column align-items-center justify-content-center">

            <div class="text-center">
                <h2 class="text-success fw-bold">Start Mission Todo</h2>
                    <p class="pt-3">ご入力いただいたメールアドレスでアカウントを作成します</p>
                        <p class="pb-2">ご利用は無料です</p>
                            <a href="{{ route('register') }}" class="btn  btn-lg btn-success pt-2">アカウントを作成</a>
            </div> 
        </div>

    </div>

</x-main>    
