
Ext.define('SIS.view.user.Edit', {
    extend: 'Ext.window.Window',
    alias: 'widget.useredit',

    title: 'Edit User',
    layout: 'fit',
    autoShow: true,

  
    initComponent:function() {
        this.items = [
            {
                xtype: 'form',
			    items : [{
							xtype : 'textfield',
							fieldLabel : '用户名',
							name : 'username',
			
						}, /*{
							xtype : 'textfield',
			
							fieldLabel : '密码',
							name : 'password',
							inputType: 'password', 
			
						},*/ {
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
  							name:'main_subject',
  							fieldLabel:'主要任教学科',
  							store:'Courses',
  							displayField:'course_name',
  							valueField:'id',
  							queryMode:'local'
  						}  
						]
            }
        ];
       
        
       
        this.buttons = [
            {
                text: 'Save',
                action: 'save'
            },
            {
                text: 'Cancel',
                scope: this,
                handler: this.close
            }
        ];
        
        this.callParent(arguments);
    }
});