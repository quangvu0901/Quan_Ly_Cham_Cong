<x-lf.page.listing :fields="$fields" :footer="$data->onEachSide(3)->links()">
    <table class="table">
        <thead>
            <tr>
                <th>
                    <x-lf.form.sort name="sId" :value="$sId">#</x-lf.form.sort>
                </th>
                <x-lf.table.label name="name" :fields="$fields">Name</x-lf.table.label>
                <x-lf.table.label name="email" :fields="$fields">Email</x-lf.table.label>
                {{-- <x-lf.table.label name="two_factor_secret" :fields="$fields">Two Factor Secret</x-lf.table.label>
			<x-lf.table.label name="two_factor_recovery_codes" :fields="$fields">Two Factor Recovery Codes</x-lf.table.label>
			<x-lf.table.label name="two_factor_confirmed_at" :fields="$fields">Two Factor Confirmed At</x-lf.table.label>
			<x-lf.table.label name="remember_token" :fields="$fields">Remember Token</x-lf.table.label> --}}
                <x-lf.table.label name="current_team_id" :fields="$fields">Current Team Id</x-lf.table.label>
                <x-lf.table.label name="profile_photo_path" :fields="$fields">Profile Photo Path</x-lf.table.label>
                <x-lf.table.label name="created_at" :fields="$fields">Created At</x-lf.table.label>
                <x-lf.table.label name="updated_at" :fields="$fields">Updated At</x-lf.table.label>
                <x-lf.table.label name="is_admin" :fields="$fields">Is Admin</x-lf.table.label>
                <x-lf.table.label name="birthday" :fields="$fields">Birthday</x-lf.table.label>
                <x-lf.table.label name="gender" :fields="$fields">Gender</x-lf.table.label>
                <x-lf.table.label name="address" :fields="$fields">Address</x-lf.table.label>
                <x-lf.table.label name="phone" :fields="$fields">Phone</x-lf.table.label>
                <x-lf.table.label name="company_id" :fields="$fields">Company Id</x-lf.table.label>
                <x-lf.table.label name="department_id" :fields="$fields">Department Id</x-lf.table.label>
                <x-lf.table.label name="position_id" :fields="$fields">Position Id</x-lf.table.label>
                <x-lf.table.label name="level" :fields="$fields">Level</x-lf.table.label>
                <x-lf.table.label name="other_info" :fields="$fields">Other Info</x-lf.table.label>

                <th></th>
            </tr>
        </thead>
        @foreach ($data as $item)
            <tr>
                <th class="stt">{{ $item->id }}</th>
                <x-lf.table.item name="name" :fields="$fields">{{ $item->name }}</x-lf.table.item>
                <x-lf.table.item name="email" :fields="$fields">{{ $item->email }}</x-lf.table.item>
                {{-- <x-lf.table.item name="two_factor_secret" :fields="$fields">{{$item->two_factor_secret}}</x-lf.table.item>
				<x-lf.table.item name="two_factor_recovery_codes" :fields="$fields">{{$item->two_factor_recovery_codes}}</x-lf.table.item>
				<x-lf.table.item name="two_factor_confirmed_at" :fields="$fields">{{$item->two_factor_confirmed_at}}</x-lf.table.item> --}}
                {{-- <x-lf.table.item name="remember_token" :fields="$fields">{{$item->remember_token}}</x-lf.table.item> --}}
                <x-lf.table.item name="current_team_id" :fields="$fields">{{ ($item->current_team_id != 0) ? $item->team->name : '' }} </x-lf.table.item>
                <x-lf.table.item name="profile_photo_path" :fields="$fields">
                    @if($item->profile_photo_path == Null)
                        <img src="{{$item->profile_photo_url}}" alt="" width="60px">
                        @else
                        <img src="/{{json_decode($item->profile_photo_path)->name}}" alt="" width="60px">
                        @endif
                </x-lf.table.item>
                <x-lf.table.item name="created_at" :fields="$fields">{{ $item->created_at }}</x-lf.table.item>
                <x-lf.table.item name="updated_at" :fields="$fields">{{ $item->updated_at }}</x-lf.table.item>
                <x-lf.table.item name="is_admin" :fields="$fields">
                    @if ($item->is_admin == 1)
                        <a class="btn-primary xs">Admin</a>
                    @else
                        <a class="btn-warning xs">Người dùng</a>
                    @endif
                </x-lf.table.item>
                <x-lf.table.item name="birthday" :fields="$fields">{{ $item->birthday }}</x-lf.table.item>
                <x-lf.table.item name="gender" :fields="$fields">{{ ($item->gender == 0) ? 'Nam' : 'Nữ' }}</x-lf.table.item>
                <x-lf.table.item name="address" :fields="$fields">{{ $item->address }}</x-lf.table.item>
                <x-lf.table.item name="phone" :fields="$fields">{{ $item->phone }}</x-lf.table.item>
                <x-lf.table.item name="company_id" :fields="$fields">{{ ($item->company_id != 0) ? $item->company->name : $item->company_id }}</x-lf.table.item>
                <x-lf.table.item name="department_id" :fields="$fields">{{ ($item->department_id != 0) ? $item->department->name : $item->department_id }}</x-lf.table.item>
                <x-lf.table.item name="position_id" :fields="$fields">{{ ($item->position_id != 0) ? $item->position->name : $item->position_id }}</x-lf.table.item>
                <x-lf.table.item name="level" :fields="$fields">{{ $item->level }}</x-lf.table.item>
                <x-lf.table.item name="other_info" :fields="$fields">{{ $item->other_info }}</x-lf.table.item>

                <td class="action">
                    @can('company.users.show')
                        <a class="btn-success xs"
                            href="{{ route('company.users.show', $item->id) }}">{!! lfIcon('launch', 10) !!}</a>
                    @endcan
                    @can('company.users.edit')
                        <a class="btn-info xs"
                            href="{{ route('company.users.edit', $item->id) }}">{!! lfIcon('edit', 10) !!}</a>
                    @endcan
                    @can('company.users.delete')
                        <x-lf.btn.delete :record="$item->id" :confirm="$confirm" />
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
    <x-slot name="filters">
        <x-lf.filter.input name="fId" type="number" placeholder="Id ..." />
    </x-slot>
    <x-slot name="tools">
        @can('company.users.create')
            <div> <a class="btn-primary sm" href="{{ route('company.users.create') }}">{!! lfIcon('add') !!}</a></div>
        @endcan
    </x-slot>
</x-lf.page.listing>
