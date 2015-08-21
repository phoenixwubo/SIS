Ext.define('SIS.view.student.Profile', {
    extend: 'Ext.window.Window',
    alias: 'widget.studentprofile',
    title: '学生详细信息',
    layout: 'fit',
//    width: 400,
//    height: 600,
    bodyPadding: 10,
    requires:['SIS.util.Utilities'],
    frame: true,
    autoShow: true,
    initComponent:function() {
    	this.items=[
            { xtype:'form', 
            	items:[
            	       {
   	            		xtype:'displayfield',
   	            		readOnly: true,
   	            		name:'dept_number',
   	            		fieldLabel:'班级',
   	 				renderer : function(value, metaData, record) { // #2
   						var departmentsStore = Ext.getStore('departments.DepartmentsRead');
   						var department = departmentsStore.findRecord('dept_number', value);
   						return department != null ? department.get('dept_name') : value;
   	 				}
               	       },
            	       {
	            		xtype:'displayfield',
	            		readOnly: true,
	            		name:'stu_number',
	            		fieldLabel:'学号'
            	       },
            	       {
    	            		xtype:'displayfield',
    	            		name:'stu_name',
    	            		fieldLabel:'姓名',
    	            	},
                        {
                        	xtype:'displayfield',
                        	fieldLabel:'性别',
                        	name:'gender',
                        	renderer:SIS.util.Utilities.renderGender
                        }, 
                        {
    	            		xtype:'displayfield',
    	            		name:'id_card_number',
    	            		fieldLabel:'身份证号码',
    	            	},
    	            	
                        {
    	            		xtype:'displayfield',
    	            		name:'nationality',
    	            		fieldLabel:'民族',
    	            		readOnly: true,
    	            	},
                        {
    	            		xtype:'displayfield',
    	            		name:'native_place',
    	            		fieldLabel:'籍贯',
    	            	},
                        {
    	            		xtype:'displayfield',
    	            		name:'address',
    	            		fieldLabel:'家庭住址',
    	            	},
                        {
    	            		xtype:'displayfield',
    	            		name:'parent_phone1',
    	            		fieldLabel:'家长电话1',
    	            	},
    	            	   {
    	            		xtype:'displayfield',
    	            		name:'parent_phone2',
    	            		fieldLabel:'家长电话2',
    	            	},
    	            	{
    	            		xtype:'displayfield',
    	            		fieldLabel:'学籍状态',
    	            		name:'status',
    	            		renderer:SIS.util.Utilities.renderStatus
    	            	},{
    	            		xtype: 'displayfield',
    	            		name:'dob',
    	            		//value:'2002-11-11',
    	            		fieldLabel:'出生日期',
    	                	format: 'Y-m-d'
    	            	}
                        
                        
                        
                        
                        
                        
            	       ]
            	
            }
           
            	
    	            ],
	this.buttons = [
	             
	                {
	                    text: '关闭',
	                    scope: this,
	                    handler: this.close
	                }
	            ];
	            
	            this.callParent(arguments);
	            }
});