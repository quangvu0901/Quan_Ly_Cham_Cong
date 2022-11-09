<?php 
 return [
	'menu' => [ 
 		[ 
			'label' => 'Đơn xin nghỉ',
			'icon' => 'event',
			'route' => 'time-keep.formapplies',
			'permission' => 'time-keep.formapplies',
			'children' => [
			],
		],
		[ 
			'label' => 'Loại đơn',
			'icon' => 'contact-mail',
			'route' => 'time-keep.applications',
			'permission' => 'time-keep.applications',
			'children' => [
			],
		],
		[ 
			'label' => 'Luật chấm công',
			'icon' => 'award',
			'route' => 'time-keep.timekeeprules',
			'permission' => 'time-keep.timekeeprules',
			'children' => [
			],
		],
		[ 
			'label' => 'Chấm công',
			'icon' => 'account-manager',
			'route' => 'time-keep.timekeeps',
			'permission' => 'time-keep.timekeeps',
			'children' => [
			],
		],

	]
];