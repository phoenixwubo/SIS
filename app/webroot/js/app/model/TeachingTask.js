Ext.define('SIS.model.TeachingTask', {

    extend: 'Ext.data.Model',
    fields: ['id','course_id','course_plan_id',{name:'user_id',type:'int'},'semester_id','department_id','note'],
    uses:['SIS.model.User'],
    associations: [{ type: 'belongsTo',name:'users', model: 'User', foreignKey: 'user_id' ,autoLoad:true} ]
});