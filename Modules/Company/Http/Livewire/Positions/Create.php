<?php

namespace Modules\Company\Http\Livewire\Positions;

use App\Models\Company;
use App\Models\position;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;

class   Create extends Component
{
    use WithLaravelFormTrait;

    public $name, $company_id=0, $level=0;
    protected $rules = [
        'name' => 'string|required|min:6',
		'company_id' => 'required',
		'level' => '',
		
    ];

    public function mount()
    {
        $this->authorize("company.positions.create");
        $this->done = 1;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->authorize("company.positions.create");
        $this->validate();
        $data = position::create([
            'name' => $this->name,
			'company_id' => $this->company_id,
			'level' => $this->level,
			
        ]);
        if ($data) {
            $this->redirectForm("company.positions", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Positions");
        lForm()->pushBreadcrumb(route("company"),"Company");
		lForm()->pushBreadcrumb(route("company.positions"),"Positions");
		lForm()->pushBreadcrumb(route("company.positions.create"),"Create");
        $companies = Company::select(Company::$listFields)->pluck("name", "id");
        return view("company::livewire.positions.create", ['companies' => $companies])
            ->layout('company::layouts.master', ['title' => 'Positions Create']);
    }
}
