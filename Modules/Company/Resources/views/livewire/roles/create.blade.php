<div class="w-full p-1 md:p-4">
    <x-lf.card title="Create" class="info">
        <x-lf.form.input name="name" type="string" label="Name" placeholder="Name ..."/>
		<x-lf.form.input name="label" type="string" label="label" placeholder="label ..."/>
		<x-lf.form.select name="company_id" type="integer" label="Company id" placeholder="Company id ..." :default="[ 0 =>'Vui lòng chọn công ty']" :params="$companies" />
		<x-lf.form.toggle name="type" label="Type" />
		
        <x-lf.form.done />
        <x-slot name="tools">
            <a class="btn-primary sm" href="{{route('company.roles')}}">{!! lfIcon("list") !!}</a>
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Create</label>
                <a class="btn" href="{{route("company.roles")}}">Cancel</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>



