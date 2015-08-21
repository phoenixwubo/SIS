
Ext.define('SIS.view.teachingTask.Edit', {
    extend: 'Ext.window.Window',
    alias: 'widget.editteachingtask',

    title: '编辑课务分工',
    layout: 'fit',
    autoShow: true,

  
    initComponent:function() {
        this.items = [
                      {
                          xtype: 'form',
          			    items : [{
          							xtype : 'combobox',
          							fieldLabel : '课时计划',
          							name : 'course_plan_id',
          							displayField:'course_info',
          							valueField:'id',
          							queryMode:'local',
          							store:'coursePlans.CoursePlanLists'
          			
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
          							name : 'department_id',
          							fieldLabel : '班级',
          							displayField:'dept_name',
          							valueField:'id',
          							queryMode:'local',
          							store:'departments.DepartmentsList'
          						}
          			
          						 ]
                      }
                  ];
       
        
       
        this.buttons = [
            {
                text: '更新',
                
                action: 'save'
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