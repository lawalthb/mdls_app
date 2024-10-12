
<?php
	class Menu{
		
	public static function navbarsideleft(){
		return [
		[
			'path' => 'home',
			'label' => "", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'admins',
			'label' => "Admins", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'appsettings',
			'label' => "App Settings", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'classes',
			'label' => "Classes", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'examsettings',
			'label' => "Exam Settings", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'examsheetperformances',
			'label' => "Exam Sheet Performances", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'examsheets',
			'label' => "Exam Sheets", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'grades',
			'label' => "Grades", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'plans',
			'label' => "Plans", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'sessions',
			'label' => "Sessions", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'subjects',
			'label' => "Subjects", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'terms',
			'label' => "Terms", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'transactions',
			'label' => "Transactions", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'users',
			'label' => "Users", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'webabouts',
			'label' => "Web Abouts", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'webbenefits',
			'label' => "Web Benefits", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'webblogcategories',
			'label' => "Web Blog Categories", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'webblogs',
			'label' => "Web Blogs", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'webcolours',
			'label' => "Web Colours", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'webcontacts',
			'label' => "Web Contacts", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'webcounters',
			'label' => "Web Counters", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'webctas',
			'label' => "Web Ctas", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'webevents',
			'label' => "Web Events", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'webexcos',
			'label' => "Web Excos", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'webgalleries',
			'label' => "Web Galleries", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'webheaders',
			'label' => "Web Headers", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'webregistrations',
			'label' => "Web Registrations", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'webresources',
			'label' => "Web Resources", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'websettings',
			'label' => "Web Settings", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'websliders',
			'label' => "Web Sliders", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'webtestimonials',
			'label' => "Web Testimonials", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'webtopbars',
			'label' => "Web Topbars", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'webvissions',
			'label' => "Web Vissions", 
			'icon' => '<i class="material-icons">extension</i>'
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
