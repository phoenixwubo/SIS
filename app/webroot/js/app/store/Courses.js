
Ext.define('SIS.store.Courses', {
    extend: 'Ext.data.Store',
    model: 'SIS.model.Course',
    autoLoad:true,
    //pageSize:SIS.util.Utilities.PageSize,
    

        
    proxy: {
        type: 'ajax',
        api:{
			create:'courses/add/',			
			read: 'courses/',
			update:'courses/edit/',
			destroy:'courses/delete/'
		},
        
        reader: {
            type: 'json',
            root: 'courseInJson',
            totalProperty:'totalCourse',
            successProperty: 'success'
        }
}
});