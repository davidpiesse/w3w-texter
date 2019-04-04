<div>
    {{--  <ul class="list-group" wire:listen="todos-updated:updateList">  --}}
    <ul class="list-group">
        @forelse ($todos as $todo)
        <li class="list-group-item">{{ $todo->name }}</li>
        @empty
        <li class="list-group-item">No Todos</li>
        @endforelse
    </ul>
    <br>
    <button wire:click="updateList" class="btn btn-primary">Manual List Update</button>
</div>
