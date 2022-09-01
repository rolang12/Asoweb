<x-app-layout>
</x-app-layout>

<div class="">
    @foreach ($userData as $Data)
        {{ $Data->users->name }}
    @endforeach
</div>
