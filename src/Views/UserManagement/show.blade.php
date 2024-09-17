<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
@if(isset($user))
    Nazwa użytkownika: {{ $user->getName() }}<br>
@elseif(isset($error))
    {{ $error }}<br>
@endif
