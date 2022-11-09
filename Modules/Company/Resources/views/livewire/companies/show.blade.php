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
				<th class="text-right pr-2">slug:</th>
				<td>{{$data->slug}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">teaser:</th>
				<td>{{$data->teaser}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">logo:</th>
				<td><img src="/{{$data->logo->name}}" alt="" width="100px"></td>
			</tr>
			<tr>
				<th class="text-right pr-2">address:</th>
				<td>{{$data->address}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">phone:</th>
				<td>{{$data->phone}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">parent_id:</th>
				<td>{{optional($data->parent)->name}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">active:</th>
				<td>{{$data->active}}</td>
			</tr>
        </table>
        <x-slot name="tools">
            @can("company.companies.listing")
                <a class="btn-primary xs" href="{{route("company.companies")}}">{!! lfIcon("list",11) !!}</a>
            @endcan
            @can("company.companies.edit")
                <a class="btn-warning xs" href="{{route("company.companies.edit",$data->id)}}">{!! lfIcon("edit",11) !!}</a>
            @endcan
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                @can("company.companies.listing")
                    <a class="btn-primary" href="{{route("company.companies")}}">{!! lfIcon("list") !!} <span>Listing</span></a>
                @endcan
                <div>
                    @can("company.companies.edit")
                        <a class="btn-warning" href="{{route("company.companies.edit",$data->id)}}">{!! lfIcon("edit") !!} <span>Edit</span></a>
                    @endcan
                </div>
            </div>
        </x-slot>
    </x-lf.card>
</div>
