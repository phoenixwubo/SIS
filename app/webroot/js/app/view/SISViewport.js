	Ext.define('SIS.view.SISViewport', {
	extend: 'Ext.container.Viewport', // #1
	alias: 'widget.mainviewport', // #2
	requires: [
		'SIS.view.Header', // #3
		//'SIS.view.department.Tree',
		'SIS.view.Manu',
		'SIS.view.TabContainer'
		//'SIS.view.course.CourseManu'
		
	],
	layout: {
		type: 'border' // #4
	},
	items: [
		{
			xtype: 'manu', // #5
			//xtype:'departmentTree',
			width: 185,
			//collapsible: true,
			region: 'west',
			style: 'background-color: #8FB488;'
		},
		
		{
			xtype: 'appheader', // #6
			region: 'north'
		},
		
//		{
//			xtype: 'tabpanel', // #7
//			//xtype:'studentlist',
//			region: 'center',
//		},
		{	
			
            xtype: 'tabcontainer',
            region: 'center',
          },
		{
		// xtype: 'container', // #8
			region: 'south',
			height: 30,
			style: 'border-top: 1px solid #4c72a4;',
			html: '<div id="titleHeader"><center><span style="font-size:10px;">南师附中江宁分校十二年一贯制学生信息管理系统 - 吴波 - http://www.nsfz.cn</span></center></div>'
		}
	]
});