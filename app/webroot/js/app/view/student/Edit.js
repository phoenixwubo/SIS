Ext.define('SIS.view.student.Edit', {
    extend: 'Ext.window.Window',
    alias: 'widget.editstudent',
    title: '编辑学生信息',
    layout: 'fit',
    //width: 200,
    //height: 200,
    bodyPadding: 10,
    frame: true,
    autoShow: true,
    initComponent:function() {
    	var statusData=[
    	     [1,'正常'],
    	     [2,'休学'],
    	     [3,'毕业'],
    	     [4,'旁听'],
    	     [5,'复读']
    	    ];
    	var store=new Ext.data.ArrayStore({
    		fields:['value','text'],
    		data:statusData
    	});
    	
    	store.load();
    	

    	
    	
    	
    	this.items=[
    	            { xtype:'form', 
    	            	items:[{
		            			xtype:'combo',
		            			name:'dept_number',
		        				fieldLabel : '年级',
		        				displayField : 'dept_name',
		        				valueField : 'dept_number',
		        				queryMode : 'local',
		        				store : 'departments.DepartmentsRead'
		            			},
    	            	       {
	    	            		xtype:'textfield',
	    	            		name:'stu_number',
	    	            		//value:'201410101',
	    	            		fieldLabel:'学号'
    	            	       },
    	            	       {
    	    	            		xtype:'textfield',
    	    	            		name:'stu_name',
    	    	            		fieldLabel:'姓名',
    	    	            		//value:'测试1'
    	    	            	},
    	                        {
    	                        	xtype:'radiogroup',
    	                        	fieldLabel:'性别',
    	                        	items:[{boxLabel:'男',name:'gender',inputValue:'1',checked:'true'},
    	                        	       {boxLabel:'女',name:'gender',inputValue:'2'},
    	                        	       ]
    	                        }, 
    	                        {
    	    	            		xtype:'textfield',
    	    	            		name:'id_card_number',
    	    	            		fieldLabel:'身份证号码',
    	    	            		//value:'3201212000201010001'
    	    	            	},
    	    	            	
    	                        {
    	    	            		xtype:'textfield',
    	    	            		name:'nationality',
    	    	            		fieldLabel:'民族',
    	    	            		//value:'汉族'
    	    	            	},
    	                        {
    	    	            		xtype:'textfield',
    	    	            		name:'native_place',
    	    	            		fieldLabel:'籍贯',
    	    	            		//value:'江苏南京'
    	    	            	},
    	                        {
    	    	            		xtype:'textfield',
    	    	            		name:'address',
    	    	            		fieldLabel:'家庭住址',
    	    	            		//value:'南京市江宁区'
    	    	            	},
    	                        {
    	    	            		xtype:'textfield',
    	    	            		name:'parent_phone1',
    	    	            		fieldLabel:'家长电话1',
    	    	            		//value:'13900000000'
    	    	            	},
    	    	            	   {
    	    	            		xtype:'textfield',
    	    	            		name:'parent_phone2',
    	    	            		fieldLabel:'家长电话2',
    	    	            		//value:'13800000000'
    	    	            	},
    	    	            	{
    	    	            		xtype:'combo',
    	    	            		emptyText:'请选择',
    	    	            		fieldLabel:'学籍状态',
    	    	            		valueField: 'value',
    	    	            		name:'status',
    	    	            		store:store,
    	    	            	},{
    	    	            		xtype: 'datefield',
    	    	            		name:'dob',
    	    	            		//value:'2002-11-11',
    	    	            		fieldLabel:'出生日期',
    	    	                	empteyText:'请选择',
    	    	                	format: 'Y-m-d'
    	    	            	}
    	                        
    	                        
    	                        
    	                        
    	                        
    	                        
    	            	       ]
    	            	
    	            }
    	           
    	            	];

        this.buttons = [
            {
                text:'保存',
                
                action:'save'
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