Ext.define('SIS.store.electives.ElectiveResults', {
    extend: 'Ext.data.Store',
    model: 'SIS.model.elective.Elective',
    autoLoad:true,
    //pageSize:SIS.util.Utilities.PageSize,
    

        
    proxy: {
        type: 'ajax',
        api:{
//			create:'electives/add/',			
			read: 'electives/listResults/',
//			update:'electives/edit/',
//			destroy:'electives/delete/'
		},
        
        reader: {
            type: 'json',
            root: 'electivesInJson',
            totalProperty:'totalElective',
            successProperty: 'success'
        }
}
});