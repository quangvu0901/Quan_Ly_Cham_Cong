<?php

namespace Modules\TimeKeep\Http\Livewire\Timekeeps;

use App\Models\Timekeep;
use App\Models\TimekeepRule;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Twilio\Rest\Bulkexports\V1\Export\DayList;

class   Create extends Component
{
    use WithLaravelFormTrait;
    public $user_id, $note=0, $today, $create_at;
    protected $rules = [
        'user_id' => '',
		'note' => '',
    ];

    public function mount()
    {
        $this->authorize("time-keep.timekeeps.create");
        $this->done = 1;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $rule = TimekeepRule::get();

        $this->authorize("time-keep.timekeeps.create");
        $data = Timekeep::create([
            'user_id' => Auth::user()->id,
			'note' => $this->note,
        ]);
        if ($data) {
            $this->redirectForm("time-keep.timekeeps", $data->id);
        }
    }

    public function render()
    {

        lForm()->setTitle("Timekeeps");
        lForm()->pushBreadcrumb(route("time-keep"),"Time Keep");
		lForm()->pushBreadcrumb(route("time-keep.timekeeps"),"Timekeeps");
		lForm()->pushBreadcrumb(route("time-keep.timekeeps.create"),"Create");

        return view("time-keep::livewire.timekeeps.create")
            ->layout('time-keep::layouts.master', ['title' => 'Timekeeps Create']);
    }
}
