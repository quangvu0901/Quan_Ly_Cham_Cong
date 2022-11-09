<?php
Route::get('/', [\Modules\TimeKeep\Http\Controllers\HomeController::class,"index"])->can('time-keep');

Route::prefix("timekeeps")->name(".timekeeps")->group(function (){
    Route::get("/", \Modules\TimeKeep\Http\Livewire\Timekeeps\Listing::class)->can("time-keep.timekeeps");
    Route::get("/chamcong/{key}", [\Modules\TimeKeep\Http\Livewire\Timekeeps\Listing::class, 'store'])->name('.store');
    Route::get("/create", \Modules\TimeKeep\Http\Livewire\Timekeeps\Create::class)->name(".create")->can("time-keep.timekeeps.create");
    Route::get("/edit/{record_id}", \Modules\TimeKeep\Http\Livewire\Timekeeps\Edit::class)->name(".edit")->can("time-keep.timekeeps.edit");
    Route::get("/show/{record_id}", \Modules\TimeKeep\Http\Livewire\Timekeeps\Show::class)->name(".show")->can("time-keep.timekeeps.show");
    //---END-OF-TIMEKEEPS---//
});

Route::prefix("timekeeprules")->name(".timekeeprules")->group(function (){
    Route::get("/", \Modules\TimeKeep\Http\Livewire\Timekeeprules\Listing::class)->can("time-keep.timekeeprules");
    Route::get("/create", \Modules\TimeKeep\Http\Livewire\Timekeeprules\Create::class)->name(".create")->can("time-keep.timekeeprules.create");
    Route::get("/edit/{record_id}", \Modules\TimeKeep\Http\Livewire\Timekeeprules\Edit::class)->name(".edit")->can("time-keep.timekeeprules.edit");
    Route::get("/show/{record_id}", \Modules\TimeKeep\Http\Livewire\Timekeeprules\Show::class)->name(".show")->can("time-keep.timekeeprules.show");
    //---END-OF-TIMEKEEPRULES---//
});

Route::prefix("applications")->name(".applications")->group(function (){
    Route::get("/", \Modules\TimeKeep\Http\Livewire\Applications\Listing::class)->can("time-keep.applications");
    Route::get("/create", \Modules\TimeKeep\Http\Livewire\Applications\Create::class)->name(".create")->can("time-keep.applications.create");
    Route::get("/edit/{record_id}", \Modules\TimeKeep\Http\Livewire\Applications\Edit::class)->name(".edit")->can("time-keep.applications.edit");
    Route::get("/show/{record_id}", \Modules\TimeKeep\Http\Livewire\Applications\Show::class)->name(".show")->can("time-keep.applications.show");
    //---END-OF-APPLICATIONS---//
});

Route::prefix("formapplies")->name(".formapplies")->group(function (){
    Route::get("/", \Modules\TimeKeep\Http\Livewire\Formapplies\Listing::class)->can("time-keep.formapplies");
    Route::get("/create", \Modules\TimeKeep\Http\Livewire\Formapplies\Create::class)->name(".create")->can("time-keep.formapplies.create");
    Route::get("/edit/{record_id}", \Modules\TimeKeep\Http\Livewire\Formapplies\Edit::class)->name(".edit")->can("time-keep.formapplies.edit");
    Route::get("/show/{record_id}", \Modules\TimeKeep\Http\Livewire\Formapplies\Show::class)->name(".show")->can("time-keep.formapplies.show");
    //---END-OF-FORMAPPLIES---//
});

//---END-OF-ROUTES---//
