/**每学期选修课时数
 * 
 */
Ext.define('SIS.store.electives.ElectiveLessons', {
    extend: 'Ext.data.Store',
    model: 'SIS.model.elective.ElectiveLesson',
    autoLoad:true,
    

        
    proxy: {
        type: 'ajax',
        api:{
//			create:'electives/add/',			
			read: 'electives/electiveLesson/',
//			update:'electives/edit/',
//			destroy:'electives/delete/'
		},
        
        reader: {
            type: 'json',
            root: 'electiveLessonInJson',
            totalProperty:'totalElectiveLesson',
            successProperty: 'success'
        }
}
});