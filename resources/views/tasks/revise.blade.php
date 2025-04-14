<x-main>

    <x-slot name="header">
        <x-side-bar>
        </x-side-bar>
    </x-slot>
    
    <x-revise :task="$task" :userLists="$userLists">
    </x-revise>
    
</x-main>    
