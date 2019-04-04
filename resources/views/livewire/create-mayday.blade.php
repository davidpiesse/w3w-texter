<div>
    <div class="form-group">
        <label for="Mobile Phone Number">Mobile Phone Number</label>
        <input wire:model.lazy="phone_number" type="text" class="form-control" name="phone_number" id="phone_number" aria-describedby="phone_numberHelp" placeholder="+447... ......" required>
        <small id="phone_numberHelp" class="form-text text-muted"> </small>
    </div>
    <button wire:click="createMayday" class="btn btn-primary">Send</button>
</div>
