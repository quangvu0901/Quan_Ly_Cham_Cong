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
				<th class="text-right pr-2">email:</th>
				<td>{{$data->email}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">email_verified_at:</th>
				<td>{{$data->email_verified_at}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">two_factor_confirmed_at:</th>
				<td>{{$data->two_factor_confirmed_at}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">current_team_id:</th>
				<td>{{($data->current_team_id != 0) ? $data->team->name : 'Không có nhóm'}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">profile_photo_path:</th>
				<td><img src="{{$data->profile_photo_url}}" alt="" width="60px"></td>
			</tr>
			<tr>
				<th class="text-right pr-2">is_admin:</th>
				<td>{{$data->is_admin}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">birthday:</th>
				<td>{{$data->birthday}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">gender:</th>
				<td>{{$data->gender == 0 ? 'Nam' : 'Nữ' }}</td>
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
				<th class="text-right pr-2">company_id:</th>
				<td>{{ ($data->company_id != 0) ? $data->company->name : $data->company_id}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">department_id:</th>
				<td>{{ ($data->department_id != 0) ? $data->department->name : $data->department_id}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">position_id:</th>
				<td>{{ ($data->position_id != 0) ? $data->position->name : $data->position_id}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">level:</th>
				<td>{{$data->level}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">other_info:</th>
				<td>{{$data->other_info}}</td>
			</tr>
        </table>
        <x-slot name="tools">
            @can("company.users.listing")
                <a class="btn-primary xs" href="{{route("company.users")}}">{!! lfIcon("list",11) !!}</a>
            @endcan
            @can("company.users.edit")
                <a class="btn-warning xs" href="{{route("company.users.edit",$data->id)}}">{!! lfIcon("edit",11) !!}</a>
            @endcan
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                @can("company.users.listing")
                    <a class="btn-primary" href="{{route("company.users")}}">{!! lfIcon("list") !!} <span>Listing</span></a>
                @endcan
                <div>
                    @can("company.users.edit")
                        <a class="btn-warning" href="{{route("company.users.edit",$data->id)}}">{!! lfIcon("edit") !!} <span>Edit</span></a>
                    @endcan
                </div>
            </div>
        </x-slot>
    </x-lf.card>
</div>
