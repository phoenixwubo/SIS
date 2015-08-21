
Ext.define('SIS.store.Students', {
    extend: 'Ext.data.Store',
    model: 'SIS.model.Student',
    //autoLoad:true,
    //pageSize:SIS.util.Utilities.PageSize,
    

        
    proxy: {
        type: 'ajax',
        api:{
			create:'students/add/',			
			read: 'students/',
			update:'students/edit/',
			destroy:'students/delete/'
		},
        
        reader: {
            type: 'json',
            root: 'studentInJson',
            totalProperty:'totalStudent',
            successProperty: 'success'
        }
}
});