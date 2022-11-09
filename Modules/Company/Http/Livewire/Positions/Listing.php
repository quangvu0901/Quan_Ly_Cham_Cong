<?php

namespace Modules\Company\Http\Livewire\Positions;

use App\Models\position;
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
		"company_id" => ["status" => true, "label" => "Company Id"],
		"level" => ["status" => true, "label" => "Level"],
		"created_at" => ["status" => true, "label" => "Created At"],
		"updated_at" => ["status" => true, "label" => "Updated At"],
		
    ];

    public function mount()
    {
        $this->authorize("company.positions.listing");
    }

    function delete()
    {
        $this->authorize("company.positions.delete");
        if ($this->confirm > 0) {
            position::destroy($this->confirm);
        }
        $this->confirm = 0;
        $this->dispatchBrowserEvent('warning', 'Positions successfully destroyed.');
    }

    public function render()
    {
        $data = new position();

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

        lForm()->setTitle("Positions");
        lForm()->pushBreadcrumb(route("company"),"Company");
		lForm()->pushBreadcrumb(route("company.positions"),"Positions");
		
        return view("company::livewire.positions.listing", compact("data"))
            ->layout('company::layouts.master', ['title' => 'Positions Create']);
    }
}
