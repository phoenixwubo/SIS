Ext.define('SIS.model.Course', {

    extend: 'Ext.data.Model',
    fields: ['course_name','id',{name:'user_id',type:'int'},'course_type',{name:'score_type',type:'int'}],
    uses:['SIS.model.User'],
    associations: [{ type: 'belongsTo',name:'users', model: 'User', foreignKey: 'user_id' ,autoLoad:true} ]
});