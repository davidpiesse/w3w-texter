<div>
    <div class="form-group">
        <label for="imput">Todo Name</label>
        <input 
            wire:model.lazy="todo" 
            type="text" class="form-control" id="input" aria-describedby="input" placeholder="Enter Todo Name">
    </div>
    <button 
        wire:click="createTodo" 
        wire:emit="click:todos-updated" 
        class="btn btn-primary">Create</button>
</div>