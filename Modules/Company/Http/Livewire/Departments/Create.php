<?php

namespace Modules\Company\Http\Livewire\Departments;

use App\Models\Company;
use App\Models\department;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;

class   Create extends Component
{
    use WithLaravelFormTrait;

    public $name, $company_id, $parent_id, $root_id;
    protected $rules = [
        'name' => 'required|min:6|max:100',
        'company_id' => 'required',
        'parent_id' => '',
        'root_id' => 'required',

    ];
    public function mount()
    {

        $this->authorize("company.departments.create");
        $this->done = 1;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->authorize("company.departments.create");
        $this->validate();
        $data = department::create([
            'name' => $this->name,
            'company_id' => $this->company_id,
            'parent_id' => $this->parent_id,
            'root_id' => $this->root_id,

        ]);
        if ($data) {
            $this->redirectForm("company.departments", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Departments");
        lForm()->pushBreadcrumb(route("company"), "Company");
        lForm()->pushBreadcrumb(route("company.departments"), "Departments");
        lForm()->pushBreadcrumb(route("company.departments.create"), "Create");
        $companies = Company::select(Company::$listFields)->pluck("name", "id");
        $departments = Department::select(Department::$listFields)->pluck("name", "id");
        return view("company::livewire.departments.create", ['companies' => $companies, 'departments' => $departments])
            ->layout('company::layouts.master', ['title' => 'Departments Create']);
    }
}
