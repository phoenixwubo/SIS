
Ext.define('SIS.view.department.Edit', {
    extend: 'Ext.window.Window',
    alias: 'widget.editdepartment',

    title: '编辑机构',
    layout: 'fit',
    autoShow: true,

  
    initComponent:function() {
        this.items = [
                      {
                          xtype: 'form',
          			    items : [{
          							xtype : 'textfield',
          							fieldLabel : '编号',
          							name : 'dept_number',
          			
          						}, {
          							xtype : 'textfield',
          			
          							fieldLabel : '名称',
          							name : 'dept_name',
          			
          						}, {
          							xtype : 'textfield',
          							name : 'year_in',
          							fieldLabel : '入学年份'
          						}, {
          							xtype : 'textfield',
          							name : 'year_graduate',
          							fieldLabel : '毕业年份'
          						},{
          							xtype:'combobox',
          							fieldLabel:'隶属于',
          							name:'parent_id',
          							displayField:'dept_name',
          							valueField:'id',
          							//queryMode:'local',
          							store:'departments.DepartmentsList'
          						},{
          							xtype:'hiddenfield',
          							name:'id'
          						}
          			
          						 ]
                      }
                  ];
       
        
       
        this.buttons = [
            {
                text: '更新',
                
                action: 'update'
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