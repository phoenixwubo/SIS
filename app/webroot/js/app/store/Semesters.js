
Ext.define('SIS.store.Semesters', {
    extend: 'Ext.data.Store',
    model: 'SIS.model.Semester',
    autoLoad:true,
    //pageSize:SIS.util.Utilities.PageSize,
    

        
    proxy: {
        type: 'ajax',
        api:{
			create:'semesters/add/',			
			read: 'semesters/',
			update:'semesters/edit/',
			destroy:'semesters/delete/'
		},
        
        reader: {
            type: 'json',
            root: 'semesterInJson',
            totalProperty:'totalSemester',
            successProperty: 'success'
        }
}
});