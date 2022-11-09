<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\Modules\Company\Http\Controllers\HomeController::class,"index"])->can('company');

Route::prefix("companies")->name(".companies")->group(function (){
    Route::get("/", \Modules\Company\Http\Livewire\Companies\Listing::class)->can("company.companies");
    Route::get("/create", \Modules\Company\Http\Livewire\Companies\Create::class)->name(".create")->can("company.companies.create");
    Route::get("/edit/{record_id}", \Modules\Company\Http\Livewire\Companies\Edit::class)->name(".edit")->can("company.companies.edit");
    Route::get("/show/{record_id}", \Modules\Company\Http\Livewire\Companies\Show::class)->name(".show")->can("company.companies.edit");
    //---END-OF-COMPANIES---//
});

Route::prefix("departments")->name(".departments")->group(function (){
    Route::get("/", \Modules\Company\Http\Livewire\Departments\Listing::class)->can("company.departments");
    Route::get("/create", \Modules\Company\Http\Livewire\Departments\Create::class)->name(".create")->can("company.departments.create");
    Route::get("/edit/{record_id}", \Modules\Company\Http\Livewire\Departments\Edit::class)->name(".edit")->can("company.departments.edit");
    Route::get("/show/{record_id}", \Modules\Company\Http\Livewire\Departments\Show::class)->name(".show")->can("company.departments.edit");
    //---END-OF-DEPARTMENTS---//
});

Route::prefix("positions")->name(".positions")->group(function (){
    Route::get("/", \Modules\Company\Http\Livewire\Positions\Listing::class)->can("company.positions");
    Route::get("/create", \Modules\Company\Http\Livewire\Positions\Create::class)->name(".create")->can("company.positions.create");
    Route::get("/edit/{record_id}", \Modules\Company\Http\Livewire\Positions\Edit::class)->name(".edit")->can("company.positions.edit");
    Route::get("/show/{record_id}", \Modules\Company\Http\Livewire\Positions\Show::class)->name(".show")->can("company.positions.edit");
    //---END-OF-POSITIONS---//
});

Route::prefix("roles")->name(".roles")->group(function (){
    Route::get("/", \Modules\Company\Http\Livewire\Roles\Listing::class)->can("company.roles");
    Route::get("/create", \Modules\Company\Http\Livewire\Roles\Create::class)->name(".create")->can("company.roles.create");
    Route::get("/edit/{record_id}", \Modules\Company\Http\Livewire\Roles\Edit::class)->name(".edit")->can("company.roles.edit");
    Route::get("/show/{record_id}", \Modules\Company\Http\Livewire\Roles\Show::class)->name(".show")->can("company.roles.edit");
    //---END-OF-ROLES---//
});

Route::prefix("emodules")->name(".emodules")->group(function (){
    Route::get("/", \Modules\Company\Http\Livewire\Emodules\Listing::class)->can("company.emodules");
    Route::get("/create", \Modules\Company\Http\Livewire\Emodules\Create::class)->name(".create")->can("company.emodules.create");
    Route::get("/edit/{record_id}", \Modules\Company\Http\Livewire\Emodules\Edit::class)->name(".edit")->can("company.emodules.edit");
    Route::get("/show/{record_id}", \Modules\Company\Http\Livewire\Emodules\Show::class)->name(".show")->can("company.emodules.edit");
    //---END-OF-EMODULES---//
});

Route::prefix("users")->name(".users")->group(function (){
    Route::get("/", \Modules\Company\Http\Livewire\Users\Listing::class)->can("company.users");
    Route::get("/create", \Modules\Company\Http\Livewire\Users\Create::class)->name(".create")->can("company.users.create");
    Route::get("/edit/{record_id}", \Modules\Company\Http\Livewire\Users\Edit::class)->name(".edit")->can("company.users.edit");
    Route::get("/show/{record_id}", \Modules\Company\Http\Livewire\Users\Show::class)->name(".show")->can("company.users.edit");
    //---END-OF-USERS---//
});

//---END-OF-ROUTES---//
