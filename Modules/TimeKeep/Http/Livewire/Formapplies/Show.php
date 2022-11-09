<?php

namespace Modules\TimeKeep\Http\Livewire\Formapplies;

use App\Models\formapply;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Show extends Component
{
    use WithLaravelFormTrait;
    public $from,$to,$days;
    public function mount()
    {
        $this->authorize("time-keep.formapplies.show");
        formapply::findOrFail($this->record_id);
        $day_from =  date('d',strtotime($this->from));
        $day_to =  date('d' ,strtotime($this->to));

        $dayFrom = intval($day_from);
        $dayTo = intval($day_to);
        $this->days = $dayTo - $dayFrom + 1;
    }

    public function render()
    {
        $data =  formapply::findOrFail($this->record_id);
        lForm()->setTitle("Formapplies");
        lForm()->pushBreadcrumb(route("time-keep"),"Time Keep");
		lForm()->pushBreadcrumb(route("time-keep.formapplies"),"Formapplies");
		lForm()->pushBreadcrumb(route("time-keep.formapplies.show",$this->record_id),"Show");
        $statusApply = [
            0 => 'Đang chờ phê duyệt',
            1 => 'Đã được phê duyệt',
            2 => 'Không được phê duyệt',
        ];
        return view("time-keep::livewire.formapplies.show", compact("data",'statusApply'))
            ->layout('time-keep::layouts.master', ['title' => 'Formapplies Show']);
    }
}
