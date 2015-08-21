
Ext.define('SIS.store.CoursePlans', {
    extend: 'Ext.data.Store',
    model: 'SIS.model.CoursePlan',
    autoLoad:true,
    

        
    proxy: {
        type: 'ajax',
        api:{
			create:'coursePlans/add/',			
			read: 'coursePlans/',
			update:'coursePlans/edit/',
			destroy:'coursePlans/delete/'
		},
        
        reader: {
            type: 'json',
            root: 'coursePlanInJson',
            totalProperty:'totalcoursePlan',
            successProperty: 'success'
        }
}
});