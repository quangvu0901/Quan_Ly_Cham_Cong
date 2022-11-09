<?php

namespace Modules\TimeKeep\Http\Livewire\Timekeeprules;

use App\Models\timekeeprule;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Show extends Component
{
    use WithLaravelFormTrait;

    public function mount()
    {
        $this->authorize("time-keep.timekeeprules.show");
        timekeeprule::findOrFail($this->record_id);
    }

    public function render()
    {
        $data =  timekeeprule::findOrFail($this->record_id);
        lForm()->setTitle("Timekeeprules");
        lForm()->pushBreadcrumb(route("time-keep"),"Time Keep");
		lForm()->pushBreadcrumb(route("time-keep.timekeeprules"),"Timekeeprules");
		lForm()->pushBreadcrumb(route("time-keep.timekeeprules.show",$this->record_id),"Show");

        return view("time-keep::livewire.timekeeprules.show", compact("data"))
            ->layout('time-keep::layouts.master', ['title' => 'Timekeeprules Show']);
    }
}
