<div class="w-full p-1 md:p-4">
    <x-lf.card title="Create" class="info">
        <x-lf.form.input name="name" type="string" label="Name" placeholder="Name ..."/>
		<x-lf.form.input name="email" type="string" label="Email" placeholder="Email ..."/>
		<x-lf.form.input name="password" type="password" label="Password" placeholder="Password ..."/>
		<x-lf.form.input name="two_factor_confirmed_at" type="datetime" label="Two factor confirmed at" placeholder="Two factor confirmed at ..."/>
		<x-lf.form.select name="current_team_id" type="integer" label="current_team_id" :default="[ 0 => 'Không có nhóm']" :params="$team" />
		{{-- <x-lf.form.picture name="logo_file" type="file" label="Profile photo path" placeholder="Profile photo path ..."  :src="$logo_url"/> --}}
		<x-lf.form.toggle name="is_admin" label="Is admin" />
		<x-lf.form.input name="birthday" type="date" label="Birthday" placeholder="Birthday ..."/>
		<x-lf.form.toggle name="gender" label="Gender" />
		<x-lf.form.input name="address" type="string" label="Address" placeholder="Address ..."/>
		<x-lf.form.input name="phone" type="string" label="Phone" placeholder="Phone ..."/>
		<x-lf.form.select name="company_id" type="integer" label="Company id" placeholder="Company id ..." :default="[ 0 =>'Vui lòng chọn công ty']" :params="$companies" />
		<x-lf.form.select name="department_id" type="integer" label="Department id" placeholder="Department id ..." :default="[ 0 =>'Vui lòng chọn phòng']" :params="$departments"/>
		<x-lf.form.select name="position_id" type="integer" label="Position id" placeholder="Position id ..." :default="[ 0 =>'Vui lòng chọn chức vụ']" :params="$positions"/>
		<x-lf.form.input name="level" type="integer" label="Level" placeholder="Level ..."/>
		<x-lf.form.textarea name="other_info" label="Other info" />
		
        <x-lf.form.done />
        <x-slot name="tools">
            <a class="btn-primary sm" href="{{route('company.users')}}">{!! lfIcon("list") !!}</a>
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Create</label>
                <a class="btn" href="{{route("company.users")}}">Cancel</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>



