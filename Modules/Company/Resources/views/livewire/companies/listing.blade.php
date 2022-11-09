<x-lf.page.listing :fields="$fields" :footer="$data->onEachSide(3)->links()">
    <table class="table">
        <thead>
        <tr>
            <th><x-lf.form.sort name="sId" :value="$sId">#</x-lf.form.sort></th>
            <x-lf.table.label name="name" :value="$sName" :fields="$fields">Name</x-lf.table.label>
			<x-lf.table.label name="slug" :fields="$fields">Slug</x-lf.table.label>
			<x-lf.table.label name="teaser" :fields="$fields">Teaser</x-lf.table.label>
			<x-lf.table.label name="logo" :fields="$fields">Logo</x-lf.table.label>
			<x-lf.table.label name="address" :fields="$fields">Address</x-lf.table.label>
			<x-lf.table.label name="phone" :fields="$fields">Phone</x-lf.table.label>
			<x-lf.table.label name="parent_id" :fields="$fields">Parent Id</x-lf.table.label>
			<x-lf.table.label name="active" :fields="$fields">Active</x-lf.table.label>
			<x-lf.table.label name="created_at" :fields="$fields">Created At</x-lf.table.label>
			<x-lf.table.label name="updated_at" :fields="$fields">Updated At</x-lf.table.label>
			
            <th></th>
        </tr>
        </thead>
        @foreach($data as $item)
            <tr style="{{($item->active == 1) ? 'opacity:1' : 'opacity: 0.6'}}">
                <th class="stt">{{$item->id}}</th>
                <x-lf.table.item name="name" :fields="$fields">{{$item->name}}</x-lf.table.item>
				<x-lf.table.item name="slug" :fields="$fields">{{$item->slug}}</x-lf.table.item>
				<x-lf.table.item name="teaser" :fields="$fields">{{$item->teaser}}</x-lf.table.item>
				<x-lf.table.item name="logo" :fields="$fields">
                    <img src="/{{$item->logo->name}}" alt="" width="100px">
                </x-lf.table.item>
				<x-lf.table.item name="address" :fields="$fields">{{$item->address}}</x-lf.table.item>
				<x-lf.table.item name="phone" :fields="$fields">{{$item->phone}}</x-lf.table.item>
				<x-lf.table.item name="parent_id" :fields="$fields">{{optional($item->parent)->name}}</x-lf.table.item>
                <x-lf.table.item name="active" :fields="$fields">
                    <x-lf.btn.toggle :val="$item->active" wire:change="changeActive({{$item->id}})" />
                </x-lf.table.item>
				<x-lf.table.item name="created_at" :fields="$fields">{{$item->created_at}}</x-lf.table.item>
				<x-lf.table.item name="updated_at" :fields="$fields">{{$item->updated_at}}</x-lf.table.item>
				
                <td class="action">
                    @can('company.companies.show')
                    <a class="btn-success xs" href="{{route("company.companies.show",$item->id)}}">{!! lfIcon("launch",10) !!}</a>
                    @endcan
                    @can('company.companies.edit')
                    <a class="btn-info xs" href="{{route("company.companies.edit",$item->id)}}">{!! lfIcon("edit",10) !!}</a>
                    @endcan
                    @can('company.companies.delete')
                    <x-lf.btn.delete :record="$item->id" :confirm="$confirm"/>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
    <x-slot name="filters">
        <x-lf.filter.input name="fId" type="number" placeholder="Id ..." />
        <x-lf.filter.input name="fName" type="text" placeholder="name ..." />
    </x-slot>
    <x-slot name="tools">
        @can("company.companies.create")
           <div> <a class="btn-primary sm" href="{{route("company.companies.create")}}">{!! lfIcon("add") !!}</a></div>
        @endcan
    </x-slot>
</x-lf.page.listing>
