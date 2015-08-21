
Ext.define('SIS.store.departments.DepartmentsRead', {
    extend: 'Ext.data.Store',
    model: 'SIS.model.department.DepartmentRead',
    autoLoad:true,
    //pageSize:SIS.util.Utilities.PageSize,
    

        
    proxy: {
        type: 'ajax',
        api:{
			//create:'departments/add/',			
			read: 'departments/',
			//update:'departments/edit/',
			//destroy:'departments/delete/'
		},
        
        reader: {
            type: 'json',
            root: 'departmentsInJson',
            totalProperty:'totaldepartments',
            successProperty: 'success'
        }
}
});