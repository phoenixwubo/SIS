Ext.define('SIS.view.student.Search', {
	  extend: 'Ext.panel.Panel',
    alias: 'widget.searchstudent',
    dockedItems : [],
    title: '搜索学生',
//    layout: 'fit',
        text: '搜索',
        initComponent:function() {
        	
//        	var store=new Ext.data.JsonStore({
////        		fields:['id','text'],
//        		url : "departments/getnodes/?node=root",
//        		autoLoad:true
//        		});
//        	
//        	store.load();
        this.items=[{
        	xtype:'combo',
        	store:'departments.DepartmentsList',
        	displayField:'dept_name',
        	valueField:'id',
        	emptyText:'请选择'
        }];
        this.callParent(arguments);
        }
}
  );

//从后台获取JSON加入到COmbo中