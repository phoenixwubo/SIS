Ext.define('SIS.model.department.DepartmentRead',{
	extend:'Ext.data.Model',
	fields:[
	        {name:'id',type:'int'},
	        {name:'dept_name',tyep:'varchar'},
	        {name:'parenet_id',tyep:'int'},
	        {name:'dept_number',tyep:'varchar'},
	        {name:'year_in',tyep:'varchar'},
	        {name:'year_graduate',tyep:'varchar'},
	        ]
});