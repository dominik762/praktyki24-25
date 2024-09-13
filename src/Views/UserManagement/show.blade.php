@if(isset($user))
    Nazwa użytkownika: {{ $user->getName() }}<br>
@elseif(isset($error))
    {{ $error }}<br>
@endif
