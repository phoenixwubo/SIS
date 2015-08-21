 Ext.define('SIS.store.coursePlans.ScoreTypes', {
	 extend: 'Ext.data.ArrayStore',
	 autoLoad:true,
//     model: 'ExamName',
	 fields: ['value','score_type'],
     data : [
         [ '1',  '考试'],
         [ '2', '考查']
     ]
 });
