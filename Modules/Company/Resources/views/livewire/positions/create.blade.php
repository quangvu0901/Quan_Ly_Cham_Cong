<div class="w-full p-1 md:p-4">
    <x-lf.card title="Create" class="info">
        <x-lf.form.input name="name" type="string" label="Name" placeholder="Name ..."/>
        <x-lf.form.select name="company_id" type="integer" label="Công ty" :default="['Vui lòng chọn Công Ty']" :params="$companies"/>
		<x-lf.form.select name="level" type="integer" label="Level"  :default="[0 => 'level 1']" :params="[1 => 'level 2', 2 => 'level 3']" />
		
        <x-lf.form.done />
        <x-slot name="tools">
            <a class="btn-primary sm" href="{{route('company.positions')}}">{!! lfIcon("list") !!}</a>
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Create</label>
                <a class="btn" href="{{route("company.positions")}}">Cancel</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>



