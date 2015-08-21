
Ext.define('SIS.store.departments.DepartmentsList', {
    extend: 'Ext.data.Store',
    model: 'SIS.model.department.DepartmentsList',
    autoLoad:true,
    //pageSize:SIS.util.Utilities.PageSize,
    

        
    proxy: {
        type: 'ajax',
        api:{
			//create:'departments/add/',			
			read: 'departments/listDept/',
			//update:'departments/edit/',
			//destroy:'departments/delete/'
		},
        
        reader: {
            type: 'json',
            root: 'deptInJson',
            totalProperty:'totalDepartment',
            successProperty: 'success'
        }
}
});