Ext.define('SIS.model.score.SubjectScore', {

    extend: 'Ext.data.Model',
    fields: ['id','course_id','course_plan_id','stu_name','dept_number','stu_number','regular','midterm', 'final', 'total', 's1', 's2'],
    uses:['SIS.model.Course'],
    associations: [{ type: 'belongsTo',name:'users', model: 'User', foreignKey: 'user_id' ,autoLoad:true} ]
});