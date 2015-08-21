Ext.define('SIS.view.Header', {					
	extend : 'Ext.toolbar.Toolbar', // #1
					alias : 'widget.appheader', // #2
					height : 30, // #3
					ui : 'footer', // #4
					style : 'border-bottom: 4px solid #4c72a4;', // #5
					items : [
{
								xtype : 'label', // #6
								html : '<div id="titleHeader">南京师范大学附属中学江宁分校<span style="font-size:12px;"> - 十二年一贯制学生信息管理系统</span></div>'
							}, {
								xtype : 'tbfill' // #7
							}, {
								xtype : 'tbseparator' // #8
							}, {
								xtype : 'button', // #9
								text : '注销',
								itemId : 'logout',
								iconCls : 'logout'
							} ]
				});