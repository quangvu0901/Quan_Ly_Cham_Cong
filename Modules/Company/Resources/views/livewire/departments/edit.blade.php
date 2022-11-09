<div class="w-full p-1 md:p-4">
    <x-lf.card title="Edit" class="warning">
        <x-lf.form.input name="name" type="string" label="Name" placeholder="Name ..."/>
		<x-lf.form.select name="company_id" type="integer" label="Công ty" :default="['Vui lòng chọn Công Ty']" :params="$companies"/> 
		<x-lf.form.select name="parent_id" type="integer" label="Parent id" placeholder="Parent id ..." :default="[0 =>'Lớp cha']" :params="$departments" />
		<x-lf.form.input name="root_id" type="integer" label="Root id" placeholder="Root id ..."/>
		
        <x-lf.form.done :params="['Listing','Create','Show']"/>
        <x-slot name="tools" >
            @can('company.departments.show')
            <a class="btn-success sm" href="{{route('company.departments.show',$record_id)}}">{!! lfIcon("launch",11) !!}</a>
            @endcan
            <a class="btn-primary sm" href="{{route('company.departments')}}">{!! lfIcon("list",11) !!}</a>
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Update</label>
                <a class="btn" href="{{route("company.departments")}}">Cancel</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>

