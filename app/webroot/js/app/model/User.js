Ext.define('SIS.model.User', {

    extend: 'Ext.data.Model',
    fields: ['username','password','fullname',{name:'gender',type:'char'},'dob',{name:'main_subject',type:'int'}]
});