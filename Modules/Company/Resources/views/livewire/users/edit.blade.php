<div class="w-full p-1 md:p-4">
    <x-lf.card title="Edit" class="warning">
        <x-lf.form.input name="name" type="string" label="Name" placeholder="Name ..." />
        <x-lf.form.input name="email" type="string" label="Email" placeholder="Email ..." />
        {{-- <x-lf.form.input name="email_verified_at" type="datetime" label="Email verified at" placeholder="Email verified at ..."/>
		<x-lf.form.input name="password" type="string" label="Password" placeholder="Password ..."/> --}}
        {{-- <x-lf.form.input name="two_factor_confirmed_at" type="datetime" label="Two factor confirmed at" placeholder="Two factor confirmed at ..."/> --}}
        <x-lf.form.input name="current_team_id" type="bigint" label="Current team id"
            placeholder="Current team id ..." />
        {{-- <x-lf.form.picture name="logo_file" type="file" label="Profile photo path"
            placeholder="Profile photo path ..." :src="$logo_url" /> --}}
        <x-lf.form.toggle name="is_admin" label="Is admin" />
        <x-lf.form.input name="birthday" type="date" label="Birthday" placeholder="Birthday ..." />
        <x-lf.form.toggle name="gender" label="Gender" />
        <x-lf.form.input name="address" type="string" label="Address" placeholder="Address ..." />
        <x-lf.form.input name="phone" type="string" label="Phone" placeholder="Phone ..." />
        <x-lf.form.select name="company_id" type="integer" label="Company id" placeholder="Company id ..."
            :default="[0 => 'Vui lòng chọn công ty']" :params="$companies" />
        <x-lf.form.select name="department_id" type="integer" label="Department id" placeholder="Department id ..."
            :default="[0 => 'Vui lòng chọn phòng']" :params="$departments" />
        <x-lf.form.select name="position_id" type="integer" label="Position id" placeholder="Position id ..."
            :default="[0 => 'Vui lòng chọn chức vụ']" :params="$positions" />
        <x-lf.form.input name="level" type="integer" label="Level" placeholder="Level ..." />
        <x-lf.form.textarea name="other_info" type="text" label="Other info" placeholder="Other info ..." />

        <x-lf.form.done :params="['Listing', 'Create', 'Show']" />
        <x-slot name="tools">
            @can('company.users.show')
                <a class="btn-success sm" href="{{ route('company.users.show', $record_id) }}">{!! lfIcon('launch', 11) !!}</a>
            @endcan
            <a class="btn-primary sm" href="{{ route('company.users') }}">{!! lfIcon('list', 11) !!}</a>
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Update</label>
                <a class="btn" href="{{ route('company.users') }}">Cancel</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>
