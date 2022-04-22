<?php

use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Home');
});

Route::get('/users', function () {
    return inertia('Users/Index', [
        'users' => User::query()
            ->when(request('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10)
            ->withQueryString()
            ->through(fn($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ]),
        'filters' => Request::only(['search'])
    ]);
});

Route::post('/users', function () {
    $request = Request::validate([
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required'
    ]);

    User::create($request);

    return redirect('/users');
});

Route::get('users/create', function () {
    return inertia('Users/Create');
});

Route::get('/settings', function () {
    return inertia('Settings');
});

Route::post('/logout', function () {
    dd(request('foo'));
});
