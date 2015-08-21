
Ext.define('SIS.view.coursePlan.Add', {
    extend: 'Ext.window.Window',
    alias: 'widget.addcourseplan',

    title: '添加课程计划',
    layout: 'fit',
    autoShow: true,

  
    initComponent:function() {
        this.items = [
                      {
                          xtype: 'form',
          			    items : [{
          							xtype : 'combobox',
          							fieldLabel : '课程名称',
          							name : 'course_id',
          							displayField:'course_name',
          							valueField:'id',
          							queryMode:'local',
          							store:'Courses'
          			
          						}, {
          							xtype : 'combobox',
          			
          							fieldLabel : '任课教师',
          							name : 'user_id',
          							displayField:'fullname',
          							valueField:'id',
          							queryMode:'local',
          							store:'Users'
          			
          						}, {
          							xtype : 'combobox',
          							name : 'semester_id',
          							fieldLabel : '学期',
          							displayField:'sem_name',
          							valueField:'id',
          							value:1,
          							queryMode:'local',
          							store:'Semesters'
          						}, {
          							xtype : 'combobox',
          							name : 'department_id',
          							fieldLabel : '班级',
          							displayField:'dept_name',
          							valueField:'id',
          							queryMode:'local',
          							store:'departments.DepartmentsList'
          						},{

    	                        	xtype:'radiogroup',
    	                        	fieldLabel:'课程类别',
    	                        	items:[{boxLabel:'必修',name:'course_type',inputValue:'1',checked:'true'},
    	                        	       {boxLabel:'选修',name:'course_type',inputValue:'2'}
    	                        	       ]
    	                        
          						},{
          							xtype:'radiogroup',
          							fieldLabel:'成绩类型',
          							items:[{boxLabel:'考试',name:'score_type',inputValue:'1',checked:'true'},
          							       {boxLabel:'考查',name:'score_type',inputValue:'2'}]
          						},{
          							xtype: 'hiddenfield',
          					        name: 'implement',
          					        value:0
          						}
          			
          						 ]
                      }
                  ];
       
        
       
        this.buttons = [
            {
                text: '添加',
                
                action: 'add'
            },
            {
                text: '取消',
                scope: this,
                handler: this.close
            }
        ];
        
        this.callParent(arguments);
    }
});