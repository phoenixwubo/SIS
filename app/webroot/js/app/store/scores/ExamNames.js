/* Ext.define('ExamName', {
     extend: 'Ext.data.Model',
     fields: ['field','Exam_name'
         {name: 'field', type: 'string'},
         {name: 'exam_name',  type: 'string'}
     ]
 });
 */
 Ext.define('SIS.store.scores.ExamNames', {
	 extend: 'Ext.data.ArrayStore',
	 autoLoad:true,
//     model: 'ExamName',
	 fields: ['field','exam_name'],
     data : [
         [ 'regular',  '平时'],
         [ 'midterm', '期中'],
         [ 'final', '期末'],
         [ 'total', '总评'],
         [ 's1',  '阶段考试1'],
         [ 's2',  '阶段考试2']
     ]
 });
