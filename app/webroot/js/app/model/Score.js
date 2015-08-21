Ext.define('SIS.model.Score', {

    extend: 'Ext.data.Model',
    fields: ['course_id','course_plan_id','stu_name','dept_number','stu_number','regular','midterm','final','total'],
    uses:['SIS.model.Course'],
    associations: [{ type: 'belongsTo',name:'users', model: 'User', foreignKey: 'user_id' ,autoLoad:true} ]
});