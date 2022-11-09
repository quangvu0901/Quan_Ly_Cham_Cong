<div class="w-full p-1 md:p-4">
    <x-lf.card title="Edit" class="warning">
        <x-lf.form.input name="name" type="string" label="Name" placeholder="Name ..."/>
		<x-lf.form.input name="slug" type="string" label="Slug" placeholder="Slug ..."/>
		<x-lf.form.input name="teaser" type="string" label="Teaser" placeholder="Teaser ..."/>
		<x-lf.form.picture name="logo_file"  label="logo_file" :src="$logo_url" />   
		<x-lf.form.input name="address" type="string" label="Address" placeholder="Address ..."/>
		<x-lf.form.input name="phone" type="string" label="Phone" placeholder="Phone ..."/>
        <x-lf.form.select name="parent_id" type="integer" label="Parent id" placeholder="Parent id ..." :default="[0 =>'Công Ty cha']" :params="$companies" />
		<x-lf.form.toggle name="active" label="Active" />
		
        <x-lf.form.done :params="['Listing','Create','Show']"/>
        <x-slot name="tools" >
            @can('company.companies.show')
            <a class="btn-success sm" href="{{route('company.companies.show',$record_id)}}">{!! lfIcon("launch",11) !!}</a>
            @endcan
            <a class="btn-primary sm" href="{{route('company.companies')}}">{!! lfIcon("list",11) !!}</a>
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Update</label>
                <a class="btn" href="{{route("company.companies")}}">Cancel</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>

