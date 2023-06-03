{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>


@role('admin')
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Администрация</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-question"></i> Пользователи</a></li>

        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Роли</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Разрешения</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('verification-stack') }}"><i class="nav-icon la la-question"></i>Подтверждение почты</a></li>
    </ul>
</li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Чаты</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('chats') }}"><i class="nav-icon la la-question"></i> Чаты</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('messages') }}"><i class="nav-icon la la-question"></i> Messages</a></li>
    </ul>
</li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('safe-shelves') }}"><i class="nav-icon la la-question"></i> Безопасные места</a></li>

@endrole

@role('manager')
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Пользователи</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-question"></i> Пользователи</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('verification-stack') }}"><i class="nav-icon la la-question"></i> Подтверждение почты</a></li>    </ul>
</li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('cities') }}"><i class="nav-icon la la-question"></i> Города</a></li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Книговорот</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('crossing-model') }}"><i class="nav-icon la la-question"></i> Книги в книговороте</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('crossing-book-model') }}"><i class="nav-icon la la-question"></i>Книговорот книги</a></li>

    </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Жанры</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('genre-model') }}"><i class="nav-icon la la-question"></i>Жанры книг</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('theme-books-model') }}"><i class="nav-icon la la-question"></i>Поджанры книг</a></li>
    </ul>
</li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Раздел отдаю</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('give-books-model') }}"><i class="nav-icon la la-question"></i> Книги</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('give-books-genre') }}"><i class="nav-icon la la-question"></i> Жанры книг</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('give-books-images') }}"><i class="nav-icon la la-question"></i>Фото</a></li>
    </ul>
</li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Книгообмен</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('swap') }}"><i class="nav-icon la la-question"></i> Обмены</a></li>
    </ul>
</li>


@endrole
