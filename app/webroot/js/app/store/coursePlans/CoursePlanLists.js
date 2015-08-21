
Ext.define('SIS.store.coursePlans.CoursePlanLists', {
    extend: 'Ext.data.Store',
    model: 'SIS.model.coursePlan.CoursePlanList',
    autoLoad:true,
    //pageSize:SIS.util.Utilities.PageSize,
    

        
    proxy: {
        type: 'ajax',
        api:{
			//create:'departments/add/',			
			read: 'courseplans/listCoursePlans/',
			//update:'departments/edit/',
			//destroy:'departments/delete/'
		},
        
        reader: {
            type: 'json',
            root: 'coursePlanInJson',
            totalProperty:'totalcoursePlan',
            successProperty: 'success'
        }
}
});