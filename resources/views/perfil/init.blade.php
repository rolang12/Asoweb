<div class="mt-20">
    @foreach ($userData as $Data)
        {{ $Data->users->name }}
    @endforeach
</div>
