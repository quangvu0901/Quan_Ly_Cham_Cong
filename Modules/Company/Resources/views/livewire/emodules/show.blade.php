<div class="w-full p-2 md:p-4 max-w-lg">
    <x-lf.card class="success" title="Show">
        <table class="table">
            <tr>
                <th class="text-right pr-2">ID:</th>
                <td>{{$data->id}}</td>
            </tr>
            
			<tr>
				<th class="text-right pr-2">name:</th>
				<td>{{$data->name}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">label:</th>
				<td>{{$data->label}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">slug:</th>
				<td>{{$data->slug}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">icon:</th>
				<td>{{$data->icon}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">permission:</th>
				<td>{{$data->permission}}</td>
			</tr>
        </table>
        <x-slot name="tools">
            @can("company.emodules.listing")
                <a class="btn-primary xs" href="{{route("company.emodules")}}">{!! lfIcon("list",11) !!}</a>
            @endcan
            @can("company.emodules.edit")
                <a class="btn-warning xs" href="{{route("company.emodules.edit",$data->id)}}">{!! lfIcon("edit",11) !!}</a>
            @endcan
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                @can("company.emodules.listing")
                    <a class="btn-primary" href="{{route("company.emodules")}}">{!! lfIcon("list") !!} <span>Listing</span></a>
                @endcan
                <div>
                    @can("company.emodules.edit")
                        <a class="btn-warning" href="{{route("company.emodules.edit",$data->id)}}">{!! lfIcon("edit") !!} <span>Edit</span></a>
                    @endcan
                </div>
            </div>
        </x-slot>
    </x-lf.card>
</div>
