<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return redirect()->route('employee.index');
});

Route::controller(EmployeeController::class)->group(function () {
    Route::get("/employee", 'index')->name('employee.index');
    Route::get("/employee/create", 'create')->name('employee.create');
    Route::post("/employee", 'store')->name('employee.store');
    Route::get("/employee/{id}/edit", 'edit')->name('employee.edit');
    Route::put("/employee/{id}", 'update')->name('employee.update');
    Route::delete("/employee/{id}", 'destroy')->name('employee.destroy');
});


// Route::get("/employee", [EmployeeController::class, 'index'])->name('employee.index');
// Route::get("/employee/create", [EmployeeController::class, 'create'])->name('employee.create');
// Route::post("/employee", [EmployeeController::class, 'store'])->name('employee.store');
// Route::get("/employee/{id}/edit", [EmployeeController::class, 'edit'])->name('employee.edit');
// Route::put("/employee/{id}", [EmployeeController::class, 'update'])->name('employee.update');
// Route::delete("/employee/{id}", [EmployeeController::class, 'destroy'])->name('employee.destroy');
