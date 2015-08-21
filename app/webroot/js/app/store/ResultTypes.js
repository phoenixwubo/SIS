 Ext.define('User', {
     extend: 'Ext.data.Model',
     fields: [
         {name: 'id', type: 'int'},
         {name: 'result_name',  type: 'string'}
     ]
 });

 Ext.define('SIS.store.ResultTypes', {
	 extend: 'Ext.data.Store',
	 autoLoad:true,
     model: 'User',
     data : [
         {id: 1,    result_name: '优秀'},
         {id: 2,    result_name: '良好'},
         {id: 3,    result_name: '及格'},
         {id: 4,    result_name: '不及格'}
     ]
 });