<x-lf.page.listing :fields="$fields" :footer="$data->onEachSide(3)->links()">
    <table class="table">
        <thead>
        <tr>
            <th><x-lf.form.sort name="sId" :value="$sId">#</x-lf.form.sort></th>
            <x-lf.table.label name="name" :fields="$fields">Name</x-lf.table.label>
			<x-lf.table.label name="label" :fields="$fields">label</x-lf.table.label>
			<x-lf.table.label name="company_id" :fields="$fields">Công Ty</x-lf.table.label>
			<x-lf.table.label name="type" :fields="$fields">Type</x-lf.table.label>
			<x-lf.table.label name="created_at" :fields="$fields">Created At</x-lf.table.label>
			<x-lf.table.label name="updated_at" :fields="$fields">Updated At</x-lf.table.label>
			
            <th></th>
        </tr>
        </thead>
        @foreach($data as $item)
            <tr>
                <th class="stt">{{$item->id}}</th>
                <x-lf.table.item name="name" :fields="$fields">{{$item->name}}</x-lf.table.item>
				<x-lf.table.item name="label" :fields="$fields">{{$item->label}}</x-lf.table.item>
				<x-lf.table.item name="company_id" :fields="$fields">{{$item->company->name}}</x-lf.table.item>
				<x-lf.table.item name="type" :fields="$fields">{{$item->type}}</x-lf.table.item>
				<x-lf.table.item name="created_at" :fields="$fields">{{$item->created_at}}</x-lf.table.item>
				<x-lf.table.item name="updated_at" :fields="$fields">{{$item->updated_at}}</x-lf.table.item>
				
                <td class="action">
                    @can('company.roles.show')
                    <a class="btn-success xs" href="{{route("company.roles.show",$item->id)}}">{!! lfIcon("launch",10) !!}</a>
                    @endcan
                    @can('company.roles.edit')
                    <a class="btn-info xs" href="{{route("company.roles.edit",$item->id)}}">{!! lfIcon("edit",10) !!}</a>
                    @endcan
                    @can('company.roles.delete')
                    <x-lf.btn.delete :record="$item->id" :confirm="$confirm"/>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
    <x-slot name="filters">
        <x-lf.filter.input name="fId" type="number" placeholder="Id ..." />
    </x-slot>
    <x-slot name="tools">
        @can("company.roles.create")
           <div> <a class="btn-primary sm" href="{{route("company.roles.create")}}">{!! lfIcon("add") !!}</a></div>
        @endcan
    </x-slot>
</x-lf.page.listing>
