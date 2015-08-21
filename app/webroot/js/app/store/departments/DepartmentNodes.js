
Ext.define('SIS.store.departments.DepartmentNodes', {
    extend: 'Ext.data.Store',
    model: 'SIS.model.Department',
    //autoLoad:true,
    

        
    proxy: {
        type: 'ajax',
       proxy:{
			type:'ajax',
			url:'/departments/getnodes/?node=root',
			reader:'json'
			},
        
       
}
});
