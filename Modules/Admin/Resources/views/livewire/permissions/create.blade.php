<div class="w-full p-1 md:p-4">
    <x-lf.card title="Create" class="info ">
        <x-lf.form.select name="module" label="Module" :params="$modules"/>
        <x-lf.form.select name="name" class="w-full md:w-1/2" label="Chọn Permission" :params="$permissions"/>
        <x-lf.form.input name="name"   class="w-full md:w-1/2" type="string" label="Hoặc nhập" placeholder="Permission ..."/>
		<x-lf.form.input name="label" type="string" label="Label" placeholder="Label ..."/>
		<x-lf.form.select name="type" label="Type" :params="['Chọn Kiểu','module'=>'Module','page'=>'Page','method'=>'Method']"/>
        @if($type=='method')
            <x-lf.form.select name="parent_id" label="Page" :default="['Select Page']" :params="$parents"/>
        @endif
        @if($type=='page')


        @endif
        <x-lf.form.done />
        <x-slot name="tools">
            <a class="btn-primary sm" href="{{route('admin.permissions')}}">{!! lfIcon("list") !!}</a>
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Create</label>
                <a class="btn" href="{{route("admin.permissions")}}">Cancel</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>



