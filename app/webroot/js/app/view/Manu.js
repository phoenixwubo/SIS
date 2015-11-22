Ext.define('SIS.view.Manu', {					
	extend : 'Ext.panel.Panel',
	layout: 'accordion',
	defaults: {
        bodyPadding: 10
    },
    alias : 'widget.manu',
    title:'功能菜单',
    items: [	/*{
			//xtype:'departmentTree',
			width: 185,
			collapsible: true,
		},*/
		{
	        title: '学生管理',
	        xtype:'treepanel',
	        id:'student',
	        rootVisible:false,
	        root:{
				children:[{
					text:'学生名单',
					id:'studentlist',
					leaf:true
				}/*,{
					text:'批量导入',
					leaf:true,
					id:'importstudent'
				},{
					text:'生源地统计',
					leaf:true,
					id:'studentstat'
					
				}*/,{
					text:'生源分析',
					leaf:true,
					iconCls:'chart',
					id:'studentchart'
				}]
			}}
    	,{
    		title:'课程管理',
    		xtype:'treepanel',
    		rootVisible:false,
    		id:'course',
    		root:{
    			children:[{
    				text:'课程目录',
    				leaf:true,
    				id:'courselist'
    			},{
    				text:'课程计划',
    				leaf:true,
    				id:'courseplanlist'
    				
    			},{
    				text:'必修课课务分工',
    				leaf:true,
    				id:'teachingtasklist'
    			},
    			/*{
    				text:'选修课课程计划',
    				leaf:true,
    				id:'electivelesson'
    				
    			},*/
    			{
    				text:'选修课学生名单',
    				leaf:true,
    				id:'electivelist'
    			}]
    		}
    	},
		{
	        title: '成绩管理',
	        xtype:'treepanel',
	        id:'score',
	        rootVisible:false,
	        root:{
				children:[{
					text:'考试成绩录入修改',
					leaf:true,
					id:'subjectscorelist'
				},
				{
					text:'班级考试成绩表查询',
					leaf:true,
					id:'scoretable'
				}/*
				,{
					text:'必修考查课成绩登记修改',
					leaf:true,
					id:'noexamresultlist'
				}				
				*/,{
					text:'考查科目成绩录入修改',
					leaf:true,
					id:'electiveresultlist'
				},{
					text:'学生成绩记录查询',
					leaf:true,
					id:'resultsheet'
				},{
					text:'考试成绩分析',
					leaf:true,
					id:'scoresectionchart',
					iconCls:'chart',
					
				}]
			}
    	},
    	/*
		{
	        title: '招生管理',
	        xtype:'treepanel',
	        rootVisible:false,
	        root:{
				children:[{
					text:'信息发布',
					leaf:'true'
				},{
					text:'报名管理',
					leaf:'true'
				},{
					text:'录取信息',
					leaf:true
				},{
					text:'生源分析',
					leaf:'true',
					iconCls:'chart',
					id:'analysis'
				}]
			}
    	},
    	{
    		title: '奖惩管理',
	        html: 'Empty'
    	},*/{
	        title: '系统管理',
	        xtype:'treepanel',
	        id:'system',
	        rootVisible:false,
	        root:{
    			text:'系统管理',
				children:[{
					text:'用户管理',
					iconCls:'users',
					id:'userlist',
					leaf:true
				},{
					text:'学期管理',
					id:'semesterlist',
					leaf:true
					
				},{			
					text:'组织机构管理',
					iconCls:'departments',
					id:'departmentpanel',
					leaf:true
				},{
					text:'权限管理',
					leaf:true
				}]
    		}
    	}
		]
});