<?php 
 return [
	'navbar' => [ 
 		[ 
			'label' => 'Quyền tài khoản',
			'icon' => 'account-manager',
			'route' => 'company.roles',
			'permission' => 'company.roles',
			'children' => [
			],
		],
		[ 
			'label' => 'Người Dùng',
			'icon' => 'person',
			'route' => 'company.users',
			'permission' => 'company.users',
			'children' => [
			],
		],
		[ 
			'label' => 'Chức Vụ',
			'icon' => 'position',
			'route' => 'company.positions',
			'permission' => 'company.positions',
			'children' => [
				[ 
					'label' => 'Tạo Mới',
					'icon' => 'add',
					'route' => 'company.positions.create',
					'permission' => 'company.positions.create',
				],
			],
		],
		[ 
			'label' => 'Phòng Ban',
			'icon' => 'department',
			'route' => 'company.departments',
			'permission' => 'company.departments',
			'children' => [
				[ 
					'label' => 'Tạo Mới',
					'icon' => 'add',
					'route' => 'company.departments.create',
					'permission' => 'company.departments.create',
				],
			],
		],
		[ 
			'label' => 'Công Ty',
			'icon' => 'business',
			'route' => 'company.companies',
			'permission' => 'company.companies',
			'children' => [
				[ 
					'label' => 'Tạo Mới',
					'icon' => 'add',
					'route' => 'company.companies.create',
					'permission' => 'company.companies.create',
				],
			],
		],

	]
];