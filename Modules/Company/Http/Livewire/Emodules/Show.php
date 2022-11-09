<?php

namespace Modules\Company\Http\Livewire\Emodules;

use App\Models\emodule;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Show extends Component
{
    use WithLaravelFormTrait;

    public function mount()
    {
        $this->authorize("company.emodules.show");
        emodule::findOrFail($this->record_id);
    }

    public function render()
    {
        $data =  emodule::findOrFail($this->record_id);
        lForm()->setTitle("Emodules");
        lForm()->pushBreadcrumb(route("company"),"Company");
		lForm()->pushBreadcrumb(route("company.emodules"),"Emodules");
		lForm()->pushBreadcrumb(route("company.emodules.show",$this->record_id),"Show");

        return view("company::livewire.emodules.show", compact("data"))
            ->layout('company::layouts.master', ['title' => 'Emodules Show']);
    }
}
