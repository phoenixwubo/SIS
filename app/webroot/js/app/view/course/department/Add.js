
Ext.define('SIS.view.department.Add', {
    extend: 'Ext.window.Window',
    alias: 'widget.adddepartment',

    title: '添加机构',
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
          							value:1,
          							queryMode:'local',
          							store:'departments.DepartmentsList'
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