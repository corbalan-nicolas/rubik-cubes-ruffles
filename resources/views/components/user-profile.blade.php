<?php
/**
 * @var \Illuminate\Database\Eloquent\Model $user
 */
?>

<dl>
    <dt>Full name</dt>
    <dd>{{ $user->name }}</dd>

    <dt>Display name</dt>
    <dd>{{ $user->display_name }}</dd>

    <dt>Email</dt>
    <dd>{{ $user->email }}</dd>

    <dt>Role</dt>
    <dd>{{ ucfirst($user->role->role) }}</dd>


    <div>
        Total of tickets bought:
        {{ $user->tickets()->count() }}
    </div>
</dl>
