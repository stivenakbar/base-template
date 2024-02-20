<div>
  <form wire:submit='notify'>
    <div>
      <x-atoms.form-label for="user-id_field" required>User</x-atoms.form-label>
      <x-atoms.select name="user_id" id="user-id_field" wire:model='user_id'>
        <option value="" selected disabled>Select User</option>
        @foreach ($users as $user)
          <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
      </x-atoms.select>
    </div>
    <x-atoms.button class="mt-7" type="submit">Send Notification</x-atoms.button>
  </form>
</div>
