Ext.define('SIS.view.department.DepartmentPanel',{
	extend: 'Ext.panel.Panel', 
	alias:'widget.departmentpanel',
	layout:{
		type:'border'
	},
    dockedItems: [
                  {
                      xtype: 'addeditdelete'
                  }
              ],
	items:[
	       {
	    	   xtype:'departmentTree',
	    	   region:'west',
	    	   width:400
	       }
	       ]
});