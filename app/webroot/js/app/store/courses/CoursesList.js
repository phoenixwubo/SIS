
Ext.define('SIS.store.courses.CoursesList', {
    extend: 'Ext.data.Store',
    model: 'SIS.model.Course',
    autoLoad:true,
    //pageSize:SIS.util.Utilities.PageSize,
    

        
    proxy: {
        type: 'ajax',
       url: 'courses/listCourse/',
        
        reader: {
            type: 'json',
            root: 'courseInJson',
            totalProperty:'totalCourse',
            successProperty: 'success'
        }
}
});