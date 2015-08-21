Ext.define('SIS.model.CoursePlan', {

    extend: 'Ext.data.Model',
    fields: ['id','course_id',{name:'user_id',type:'int'},'semester_id','score_type',{name:'score_type',type:'int'},{name:'course_type',type:'int'},'department_id','implement','note'],
    uses:['SIS.model.User'],
    associations: [{ type: 'belongsTo',name:'users', model: 'User', foreignKey: 'user_id' ,autoLoad:true} ]
});