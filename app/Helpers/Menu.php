
<?php
	class Menu{
		
	public static function navbarsideleft(){
		return [
		[
			'path' => 'home',
			'label' => "Dashboard", 
			'icon' => '<i class="material-icons ">dashboard</i>'
		],
		
		[
			'path' => '',
			'label' => "Student Management", 
			'icon' => '<i class="material-icons ">supervisor_account</i>','submenu' => [
		[
			'path' => 'users',
			'label' => "Students", 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => 'users/add',
			'label' => "Admission", 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => "Bulk Adminssion", 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => 'parents',
			'label' => "Parents", 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => "Banned Students", 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		]
	]
		],
		
		[
			'path' => '',
			'label' => "Academics", 
			'icon' => '<i class="material-icons ">class</i>','submenu' => [
		[
			'path' => 'subjects',
			'label' => "Subjects", 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => 'classes',
			'label' => "Classes", 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => 'terms',
			'label' => "Terms", 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => 'sessions',
			'label' => "Sessions", 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => "Assign Class Teacher", 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => "Promote Students", 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		]
	]
		],
		
		[
			'path' => '',
			'label' => "Examination", 
			'icon' => '<i class="material-icons ">library_books</i>','submenu' => [
		[
			'path' => 'grades',
			'label' => "Grade System", 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => "Assign Score to Student", 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => "Assign Score to Subject", 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => 'examsheets',
			'label' => "Terminal Sheet", 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => 'examsettings',
			'label' => "Exam Settings", 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => 'examsheetperformances',
			'label' => "Exam Sheet Performances", 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		]
	]
		],
		
		[
			'path' => '',
			'label' => "Staff Management", 
			'icon' => '<i class="material-icons ">account_circle</i>','submenu' => [
		[
			'path' => 'users/add',
			'label' => "Add Staff", 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => 'users',
			'label' => "Bans", 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => "Reset Password", 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		]
	]
		],
		
		[
			'path' => '',
			'label' => "Website Management", 
			'icon' => '<i class="material-icons ">web</i>'
		],
		
		[
			'path' => 'appsettings',
			'label' => "App Settings", 
			'icon' => '<i class="material-icons ">settings_applications</i>'
		],
		
		[
			'path' => '',
			'label' => "Profile", 
			'icon' => '<i class="material-icons ">person</i>'
		],
		
		[
			'path' => 'menu9',
			'label' => "LogOut", 
			'icon' => '<i class="material-icons ">subdirectory_arrow_left</i>'
		]
	] ;
	}
	
		
	public static function isActive(){
		return [
		[
			'value' => 'Yes', 
			'label' => "Yes", 
		],
		[
			'value' => 'No', 
			'label' => "No", 
		],] ;
	}
	
	public static function directorApproval(){
		return [
		[
			'value' => 'Approved', 
			'label' => "Approved", 
		],
		[
			'value' => 'Not Yet', 
			'label' => "Not Yet", 
		],
		[
			'value' => 'Disapproved', 
			'label' => "Disapproved", 
		],] ;
	}
	
	public static function parentType(){
		return [
		[
			'value' => 'Father', 
			'label' => "Father", 
		],
		[
			'value' => 'Monther', 
			'label' => "Monther", 
		],] ;
	}
	
	public static function religion(){
		return [
		[
			'value' => 'Christian', 
			'label' => "Christian", 
		],
		[
			'value' => 'Islam', 
			'label' => "Islam", 
		],
		[
			'value' => 'Others', 
			'label' => "Others", 
		],] ;
	}
	
	public static function bloodGroup(){
		return [
		[
			'value' => 'O+', 
			'label' => "O+", 
		],
		[
			'value' => 'A+', 
			'label' => "A+", 
		],
		[
			'value' => 'B+', 
			'label' => "B+", 
		],
		[
			'value' => 'AB+', 
			'label' => "AB+", 
		],
		[
			'value' => 'O-', 
			'label' => "O-", 
		],
		[
			'value' => 'A-', 
			'label' => "A-", 
		],
		[
			'value' => 'B-', 
			'label' => "B-", 
		],
		[
			'value' => 'AB-', 
			'label' => "AB-", 
		],] ;
	}
	
	public static function status(){
		return [
		[
			'value' => 'Pending', 
			'label' => "Pending", 
		],
		[
			'value' => 'Success', 
			'label' => "Success", 
		],
		[
			'value' => 'Failed', 
			'label' => "Failed", 
		],] ;
	}
	
	}
