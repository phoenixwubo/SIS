Ext.define('SIS.model.Department',{
	extend:'Ext.data.Model',
	fields:[
	        {name:'id',type:'int'},
	        {name:'pid',type:'int'},
	        {name:'deptname',tyep:'varchar'},
	        {name:'leaf',type:'boolean',defaultValue:true},
	        {name:'url',type:'varchar'}]
});