
Ext.define('SIS.view.user.Add', {
    extend: 'Ext.window.Window',
    alias: 'widget.useradd',

    title: '添加成员',
    layout: 'fit',
    autoShow: true,
    modal: true,
  
    initComponent:function() {
        this.items = [
                      {
                          xtype: 'form',
          			    items : [{
          							xtype : 'textfield',
          							fieldLabel : '用户名',
          							name : 'username',
          			
          						}, {
          							xtype : 'textfield',
          			
          							fieldLabel : '密码',
          							name : 'password',
          							inputType: 'password',
          			
          						}, {
          							xtype : 'textfield',
          							name : 'fullname',
          							fieldLabel : '姓名'
          						}, {
          							xtype : 'datefield',
          							name : 'dob',
          							fieldLabel : '出生日期',
          							format : 'Y-m-d'
          						},
          			
          						{
          							xtype : 'radiogroup',
          							//name:'gender',
          							fieldLabel : '性别',
          			
          							//value:{'gender':'1'},
          							items : [ {
          								boxLabel : '男',
          								name : 'gender',
          								inputValue : '1'
          							}, {
          								boxLabel : '女',
          								name : 'gender',
          								inputValue : '2'
          							}, ]
          						},{
          							xtype:'combo',
          							fieldLabel:'主要任教学科',
          							store:'Courses',
          							displayField:'course_name',
          							valueField:'id',
          							queryMode:'local'
          						} ]
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