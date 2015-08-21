
//课时管理
Ext.define('SIS.view.elective.AddElectivePlan', {
    extend: 'Ext.window.Window',
    alias: 'widget.addelectiveplan',

    title: '添加选修课课时计划',
    layout: 'fit',
    autoShow: true,

  
    initComponent:function() {
        this.items = [
                      {
                          xtype: 'form',
          			    items : [  {
          							xtype : 'combobox',
          							name : 'semester_id',
          							fieldLabel : '学期',
          							displayField:'sem_name',
          							valueField:'id',
          							value:1,
          							queryMode:'local',
          							store:'Semesters'
          						},{

          							xtype : 'combobox',
          							name : 'department_id',
          							fieldLabel : '班级',
          							displayField:'dept_name',
          							valueField:'id',
          							queryMode:'local',
          							store:'departments.DepartmentsList'
          						
          						}, {
          							xtype : 'numberfield',
          							name : 'number',
          							fieldLabel : '选修课数量',
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