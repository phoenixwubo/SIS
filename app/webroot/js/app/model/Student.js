Ext.define('SIS.model.Student', {

    extend: 'Ext.data.Model',
    fields: ['id','stu_name',
             'dept_number',             
             'stu_number','dob',
             'nationality','native_place','address',
             'parent_phone1','parent_phone2','id_card_number',
             {name:'status',type:'int'},{name:'gender',type:'char'},  
          	'note']
});