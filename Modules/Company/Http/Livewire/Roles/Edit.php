<?php

namespace Modules\Company\Http\Livewire\Roles;

use App\Models\Company;
use App\Models\role;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Edit extends Component
{
    use WithLaravelFormTrait;

    public $name, $label, $company_id, $type;

    protected function rules()
    {
        return [
            'name' => 'string',
			'label' => '',
			'company_id' => '',
			'type' => '',
			
        ];
    }

    public function mount()
    {
        $this->authorize("company.roles.edit");
        $data = role::findOrFail($this->record_id);
        $this->name = $data->name;
		$this->label = $data->label;
		$this->company_id = $data->company_id;
		$this->type = $data->type;
		
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->authorize("company.roles.edit");
        $this->validate();
        $data = role::findOrFail($this->record_id);
        $data->fill([
            'name' => $this->name,
			'label' => $this->label,
			'company_id' => $this->company_id,
			'type' => $this->type,
			
        ]);
        if (!$data->clean) {
            $data->update();
            $this->redirectForm("company.roles", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Roles");
        lForm()->pushBreadcrumb(route("company"),"Company");
		lForm()->pushBreadcrumb(route("company.roles"),"Roles");
		lForm()->pushBreadcrumb(route("company.roles.edit",$this->record_id),"Edit");
        $companies = Company::select(Company::$listFields)->pluck("name", "id");
        return view("company::livewire.roles.edit", ['companies' => $companies])
            ->layout('company::layouts.master', ['label' => 'Roles Edit']);
    }
}
