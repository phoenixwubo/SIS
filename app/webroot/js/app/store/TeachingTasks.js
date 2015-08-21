
Ext.define('SIS.store.TeachingTasks', {
    extend: 'Ext.data.Store',
    model: 'SIS.model.TeachingTask',
    autoLoad:true,
    

        
    proxy: {
        type: 'ajax',
        api:{
			create:'teachingTasks/add/',			
			read: 'teachingTasks/',
			update:'teachingTasks/edit/',
			destroy:'teachingTasks/delete/'
		},
        
        reader: {
            type: 'json',
            root: 'teachingTasksInJson',
            totalProperty:'totalteachingTasks',
            successProperty: 'success'
        }
}
});