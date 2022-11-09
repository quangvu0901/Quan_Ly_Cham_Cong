<?php

namespace Modules\Company\Http\Livewire\Roles;

use App\Models\Company;
use App\Models\role;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;

class   Create extends Component
{
    use WithLaravelFormTrait;

    public $name, $label, $company_id, $type;
    protected $rules = [
        'name' => 'string',
		'label' => '',
		'company_id' => '',
		'type' => '',
		
    ];

    public function mount()
    {
        $this->authorize("company.roles.create");
        $this->done = 1;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->authorize("company.roles.create");
        $this->validate();
        $data = role::create([
            'name' => $this->name,
			'label' => $this->label,
			'company_id' => $this->company_id,
			'type' => $this->type,
        ]);
        if ($data) {
            $this->redirectForm("company.roles", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Roles");
        lForm()->pushBreadcrumb(route("company"),"Company");
		lForm()->pushBreadcrumb(route("company.roles"),"Roles");
		lForm()->pushBreadcrumb(route("company.roles.create"),"Create");
		$companies = Company::select(Company::$listFields)->pluck("name", "id");
        return view("company::livewire.roles.create", ['companies' => $companies])
            ->layout('company::layouts.master', ['title' => 'Roles Create']);
    }
}
