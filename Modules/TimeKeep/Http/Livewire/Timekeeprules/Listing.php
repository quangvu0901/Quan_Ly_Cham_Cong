<?php

namespace Modules\TimeKeep\Http\Livewire\Timekeeprules;

use App\Models\timekeeprule;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;
use App\Http\Livewire\ShowHideComponent;

class Listing extends Component{
    use WithLaravelFormTrait;
    public $confirm = 0;
    // Filter
    public $fId,$input,$output,$value= [],$status = 1,$count,$option,$before,$after,$late,$soon,$active = 0;
    // Sort
    public $sId = 0;
    public $fields = [
        "id" => ["status" => true, "label" => "Id"],
		"name" => ["status" => true, "label" => "Name"],
		"value" => ["status" => true, "label" => "Value"],
		"type" => ["status" => true, "label" => "Type"],
		"status" => ["status" => true, "label" => "Status"],
		"active" => ["status" => true, "label" => "Active"],
		"created_at" => ["status" => true, "label" => "Created At"],
		"updated_at" => ["status" => true, "label" => "Updated At"],
    ];

    public function mount(){
        $this->authorize("time-keep.timekeeprules.listing");
    }

    function delete()
    {
        $this->authorize("time-keep.timekeeprules.delete");
        if ($this->confirm > 0) {
            timekeeprule::destroy($this->confirm);
        }
        $this->confirm = 0;
        $this->dispatchBrowserEvent('warning', 'Timekeeprules successfully destroyed.');
    }

    public function changeActive($record_id){
        $this->authorize("time-keep.timekeeprules.listing");

        $data  = TimekeepRule::findOrFail($record_id);
        TimekeepRule::where('active', 1)->update([
            "active" => $data->active
        ]);
        $data->update([
            "active" => !$data->active
        ]);
        $this->dispatchBrowserEvent('warning', 'Successfully Updated.');
    }

    public function changeStatus($record_id){
        $this->authorize("time-keep.timekeeprules.listing");
        $data  = TimekeepRule::findOrFail($record_id);
        $data->update([
            "status" => !$data->status
        ]);
        $this->dispatchBrowserEvent('warning', 'Successfully Updated.');
    }
    public function render(){
        $data = new timekeeprule();
        if ($this->fId > 0) {
            $data = $data->whereId($this->fId);
        }
        if ($this->sId == 1) {
            $data = $data->orderBy("id");
        }
        if ($this->sId == 2) {
            $data = $data->orderByDesc("id");
        }
        $data = $data->paginate(30);

        lForm()->setTitle("Timekeeprules");
        lForm()->pushBreadcrumb(route("time-keep"),"Time Keep");
		lForm()->pushBreadcrumb(route("time-keep.timekeeprules"),"Timekeeprules");

        $timekeeping_rules = [
            'shift_rules' => [
                'shift' => [
                    'input' => $this->input,
                    'output' => $this->output,
                    'count' => $this->count,
                    'option' => $this->option,
                    'day_apply' => [
                        '0' => '2',
                        '1' => '3',
                        '2' => '4',
                        '3' => '5',
                        '4' => '6',
                        '5' => 't7',
                        '6' => 'cn',
                    ],
                ],
            ],
            'day_rules' => [
                'hours' => [
                    'time_morning' => [
                        'input_time' => $this->input,
                        'output_time' => $this->output,
                        'count' => $this->count,
                        'option' => [
                            'before' => $this->before,
                            'after' => $this->after,
                        ],
                    ],
                    'time_afternoon' => [
                        'input_time' => $this->input,
                        'output_time' => $this->output,
                        'count' => $this->count,
                        'option' => [
                            'before' => $this->before,
                            'after' => $this->after,
                        ],
                    ],
                ],
                'punish' => [
                    'come_late' => $this->late,
                    'back_soon' => $this->soon,
                ],
            ],
        ];
        return view("time-keep::livewire.timekeeprules.listing", compact("data",))
            ->layout('time-keep::layouts.master', ['title' => 'Timekeeprules Listing']);
    }
}
