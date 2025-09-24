<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;

Route::get('/', [ContactController::class, 'index'])->name('contact.index');

Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');

Route::post('/thanks', [ContactController::class, 'send'])->name('contact.thanks');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::delete('/contacts/{id}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');
    Route::get('/export', [AdminContactController::class, 'export'])->name('contacts.export');
});

Route::get('/admin/contacts/{contact}', [AdminContactController::class, 'show']);
