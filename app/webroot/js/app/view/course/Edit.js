
Ext.define('SIS.view.course.Edit', {
    extend: 'Ext.window.Window',
    alias: 'widget.editcourse',

    title: '修改课程',
    layout: 'fit',
    autoShow: true,

	  
    initComponent : function() {
		var courseTypeData = [ [ 1, '必修' ], [ 2, '选修' ], [ 3, '其他' ] ];
		var courseTypeStore = new Ext.data.ArrayStore({
			fields : [ 'value', 'text' ],
			data : courseTypeData
		});

		courseTypeStore.load();

		var scoreTypeData = [ [ 1, '考试' ], [ 2, '考查' ] ];
		var scoreTypeStore = new Ext.data.ArrayStore({
			fields : [ 'value', 'text' ],
			data : scoreTypeData
		});

		scoreTypeStore.load();
        this.items = [
                      {
                          xtype: 'form',
          			    items : [{
          							xtype : 'textfield',
          							fieldLabel : '课程名称',
          							name : 'course_name',
          							displayField:'course_name',
          			
          						}, {
          							xtype : 'combobox',
          			
          							fieldLabel : '负责教师',
          							name : 'user_id',
          							displayField:'fullname',
          							valueField:'id',
          							queryMode:'local',
          							store:'Users'
          			
          						}, {
          							xtype : 'combobox',
          							name : 'course_type',
          							fieldLabel : '课程类型',
          							displayField : 'text',
          							valueField : 'value',
          							value : 1,
          							queryMode : 'local',
          							store : courseTypeStore
          						}, {
          							xtype : 'combobox',
          							name : 'score_type',
          							fieldLabel : '成绩类型',
          							displayField : 'text',
          							valueField : 'value',
          							value : 1,
          							queryMode : 'local',
          							store : scoreTypeStore
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