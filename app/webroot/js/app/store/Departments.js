Ext.define('SIS.store.Departments',{
	extend:'Ext.data.TreeStore',
	//defaultRoot:'root',
	require:'SIS.model.Department',
	//model:'SIS.model.Department',
	expanded: true,
	autoLoad:true,
	proxy:{
	type:'ajax',
	url:'/departments/getnodes/',
	reader:'json'
}
}
		);


/*new Ext.data.TreeStore({
	proxy:{
	type:'ajax',
	//url:'/js/app/data/departments.json',
	url:'/departments/getnodes/',
	reader:'json'
	}	
	
})*/