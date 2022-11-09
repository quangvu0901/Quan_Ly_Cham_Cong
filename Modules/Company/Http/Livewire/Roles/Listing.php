<?php

namespace Modules\Company\Http\Livewire\Roles;

use App\Models\role;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;

class Listing extends Component
{
    use WithLaravelFormTrait;

    public $confirm = 0;
    // Filter
    public $fId;
    // Sort
    public $sId = 0;
    public $fields = [
        "id" => ["status" => true, "label" => "Id"],
		"name" => ["status" => true, "label" => "Name"],
		"label" => ["status" => true, "label" => "Title"],
		"company_id" => ["status" => true, "label" => "Company Id"],
		"type" => ["status" => true, "label" => "Type"],
		"created_at" => ["status" => true, "label" => "Created At"],
		"updated_at" => ["status" => true, "label" => "Updated At"],
		
    ];

    public function mount()
    {
        $this->authorize("company.roles.listing");
    }

    function delete()
    {
        $this->authorize("company.roles.delete");
        if ($this->confirm > 0) {
            role::destroy($this->confirm);
        }
        $this->confirm = 0;
        $this->dispatchBrowserEvent('warning', 'Roles successfully destroyed.');
    }

    public function render()
    {
        $data = new role();

        if ($this->fId > 0) {
            $data = $data->whereId($this->fId);
        }
        if ($this->sId == 1) {
            $data = $data->orderBy("id");
        }
        if ($this->sId == 2) {
            $data = $data->orderByDesc("id");
        }
        $data = $data->with('company')->paginate(30);

        lForm()->setTitle("Roles");
        lForm()->pushBreadcrumb(route("company"),"Company");
		lForm()->pushBreadcrumb(route("company.roles"),"Roles");
		
        return view("company::livewire.roles.listing", compact("data"))
            ->layout('company::layouts.master', ['title' => 'Roles Create']);
    }
}
