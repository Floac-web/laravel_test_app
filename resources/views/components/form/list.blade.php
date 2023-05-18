<ul class="list-group list-group-flush" style="display:{{ $show ? 'block' : 'none' }}">
    @if(isset($items))
        @foreach ($items as $item)
            <li class="list-group-item" wire:click='{{ $onClick }}({{ $item }})'>{{ $item->$name }}</li>
        @endforeach
    @endif
</ul>
