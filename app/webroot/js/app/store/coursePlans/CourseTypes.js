 Ext.define('SIS.store.coursePlans.CourseTypes', {
	 extend: 'Ext.data.ArrayStore',
	 autoLoad:true,
	 fields: ['value','course_type'],
     data : [
         [ '1',  '考试'],
         [ '2', '考查']
     ]
 });
