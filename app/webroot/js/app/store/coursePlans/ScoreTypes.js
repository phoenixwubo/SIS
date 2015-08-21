 Ext.define('SIS.store.scores.CourseType', {
	 extend: 'Ext.data.ArrayStore',
	 autoLoad:true,
//     model: 'ExamName',
	 fields: ['value','score_type'],
     data : [
         [ '1',  '必修'],
         [ '2', '选修']
     ]
 });
