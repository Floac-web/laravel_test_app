<div>
    @if(!$photos->isEmpty())
        <ul wire:sortable="reorder" class="w-100 d-flex flex-wrap">
            @foreach ($photos as $photo)
                <li wire:sortable.item='{{ $photo->id }}'  key='{{ $photo->id }}' class="p-2">
                    <div style="width: 220px; height: 120px;  overflow:hidden;">
                        <img style="width: 250px; heidth: 120px;" src="{{ $photo->url }}" >
                    </div>
                    <button class="btn btn-danger" wire:click='deleteImg({{ $photo->id }})'>delete img</button>
                </li>
            @endforeach
        <form wire:submit.prevent='saveOrderes'>
            <button class="btn btn-success">save orderers</button>
        </form>
        </ul>
    @endif
</div>


