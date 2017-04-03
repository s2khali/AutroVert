<?php

Route::set('home', function() {
    Home::CreateView('home');
});

Route::set('index.php', function () {
    Index::CreateView('index');
});

Route::set('forgot-pass', function () {
    ForgotPass::CreateView('forgot-pass');
});

Route::set('profile', function() {
    Profile::CreateView('profile');
});


?>