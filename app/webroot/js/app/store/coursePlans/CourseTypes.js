 Ext.define('SIS.store.scores.CourseType', {
	 extend: 'Ext.data.ArrayStore',
	 autoLoad:true,
//     model: 'ExamName',
	 fields: ['value','course_type'],
     data : [
         [ '1',  '考试'],
         [ '2', '考查']
     ]
 });
