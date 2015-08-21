/**
 *显示课程列表
 */
Ext.define('SIS.view.coursePlan.List' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.courseplanlist',
   
    title: '课程目录',
    store:'CoursePlans',
    stripeRows: true,
    renderScoreType:function(value){

		 switch (value)
	    	{
	    	case 1:return "考试";
	    	break;
	    	case 2:return '考查';
	    	break;
	    	default :return '其他';
	    	}
		 
    	
    },
    renderCourseType:function(value, metaData, record){
    	
		 switch (value)
	    	{
	    	case 1:return "必修";
	    	break;
	    	case 2:return '选修';
	    	break;
	    	default :return '其他';
	    	}
		 
   	
   },
   renderImplementType:function(value){

		 switch (value)
	    	{
	    	case 1:return "已部署";
	    	break;
	    	case 2:return '已有数据';
	    	break;
	    	default :return '未部署';
	    	}
		 
 	
 },
 renderImplementIcon:function(grid,rowIndex){
	 
	 var rec = grid.getStore().getAt(rowIndex);	 
//	console.log(rec);
	Ext.Ajax.request({  
        url: '/courseplans/implement/', // 向此处发送Ajax请求  
        method: 'POST',  
        params: { // 指定请求参数  
            id: rec.data.id,
            course_type:rec.data.course_type,
            score_type:rec.data.score_type,
            department_id: rec.data.department_id,
            semester_id: rec.data.semester_id

            
        }, // 指定服务器响应完成的回调函数  
        success: function(response){  
        	grid.getStore().reload();  
            alert(Ext.JSON.decode(response.responseText).tip);  
        },
        failure:function(){
        	alert('请刷新后重试');
        }
    });  
},
   dockedItems: [{
	   				xtype:'filtsubject'
   				},
                 {
                     xtype: 'addeditdelete'
                 },{
                	 xtype:'pagenate',
                	 store:'CoursePlans'
                 }
             ],
    initComponent: function() {
        this.columns = [
                        {header: 'ID',  dataIndex: 'id'},            
                        {header: '课程名称',  
                        	dataIndex: 'course_id',  
                        	flex: 1,
                        	renderer : function(value, metaData, record) { 
								var coursesStore = Ext.getStore('Courses');
								var course = coursesStore.findRecord('id', value);
								return course != null ? course.get('course_name') :value==null?"<span style='color:red;'>选修</sapn>":value;
							}},
						{header: '班级',  
                        	dataIndex: 'department_id',  
                        	flex: 1,
                        	renderer : function(value, metaData, record) { // #2
								var usersStore = Ext.getStore('departments.DepartmentsList');
								var user = usersStore.findRecord('id', value);
								return user != null ? user.get('dept_name') : value;
							}},
				        {
							header : '任课教师',
							dataIndex : 'user_id',
							flex : 1,
							renderer : function(value, metaData, record) { // #2
								var usersStore = Ext.getStore('Users');
								var user = usersStore.findRecord('id', value);
								return user != null ? user.get('fullname') : value;
							}
						},
                     
                        {header: '成绩类型', dataIndex: 'score_type', flex: 1,renderer:this.renderScoreType},
                        {header: '课程类型', dataIndex: 'course_type', flex: 1,renderer:this.renderCourseType},
                        {header: '学期',  
                        	dataIndex: 'semester_id',
                        	flex: 1,
							renderer : function(value, metaData, record) { // #2
								var semestersStore = Ext.getStore('Semesters');
								var semester = semestersStore.findRecord('id', value);
								return semester != null ? semester.get('sem_name') : value;
							}},
                        {header: '备注', dataIndex: 'note', flex: 1},
                        {header: '情况',  
                        	dataIndex: 'implement',
                        	flex: 1,
							renderer :this.renderImplementType
                        },
                        {flex: 1,
                        	header:'操作',
                            xtype: 'actioncolumn',
                            width: 30,
                            sortable: false,
                            menuDisabled: true,
                            items: [{
//                                icon: 'resources/images/icons/fam/delete.gif',
                            	iconCls: 'implement',
//                            	iconCls:this.renderImplementType,
                                tooltip: '部署课程计划',
                                scope: this,
                                handler: this.renderImplementIcon
                            }]
                        }
                    ];
        
        this.callParent(arguments);
    	},
    	 
    });