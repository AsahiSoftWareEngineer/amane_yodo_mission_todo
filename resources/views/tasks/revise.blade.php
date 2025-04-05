<x-main>

    <x-slot name="header">
        <x-sidebar>
        </x-sidebar>
    </x-slot>
  
    <x-revise :task="$task" :userLists="$userLists">
    </x-revise>
    
</x-main>    
