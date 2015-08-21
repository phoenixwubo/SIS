//Ext.onReady(function(){
	Ext.QuickTips.init();

	var form=new Ext.form.FormPanel({

	title:'编辑学生信息',
	defaultType:'textfield',
	buttonAlign:'center',
	frame:true,
	width:600,
	fieldDefaults:{
		labelAlign:'right',
		labelWidth:70
	},
	items:[{
		xtype:'container',
	    layout:'column',
	    items:[
	              {columnWidth:.7,
	            	  xtype:'fieldset',
	            	  checkboxToggle:true,
	            	  title:'单纯输入',
	            	  defaultType:'textfield',
	            	  items:[{
	            		  fieldLabel:'姓名',
	            		  name:'name'
	            	  },{
	            		  xtype:'numberfield',
	            		  fieldLabel:'学号',
	            		  name:'StuNumber'
	            	  },{
	            		  xtype:'combo',
	            		  fieldLabel:'班级',
	            		  store:new Ext.data.SimpleStore({
	            			fields:['value','text'],
	            			data:[
	            			     ['1','高一 '],
	            			     ['2','高二']
	            			      ]
	            		  }),
	            		  displayField:'text',
	            		  value:'value',
	            		  mode:'local',
	            		  emptyText:'请选择'
	            	  }
	            	  ]},
	            	  
	              ]},
	              
	/*  */],
	buttons:[{
		text:'添加',
		handler:function(btn){
		Ext.MessageBox.show({
			
		});
	}
	},{
		text:'删除'
	},{
		text:'清空'
	}]
});
//form.render(Ext.getBody());

//});