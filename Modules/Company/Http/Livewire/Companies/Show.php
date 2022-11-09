<?php

namespace Modules\Company\Http\Livewire\Companies;

use App\Models\company;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Show extends Component
{
    use WithLaravelFormTrait;

    public function mount()
    {
        $this->authorize("company.companies.show");
        company::findOrFail($this->record_id);
    }

    public function render()
    {
        $data =  company::findOrFail($this->record_id);
        lForm()->setTitle("Companies");
        lForm()->pushBreadcrumb(route("company"),"Company");
		lForm()->pushBreadcrumb(route("company.companies"),"Companies");
		lForm()->pushBreadcrumb(route("company.companies.show",$this->record_id),"Show");

        return view("company::livewire.companies.show", compact("data"))
            ->layout('company::layouts.master', ['title' => 'Companies Show']);
    }
}
