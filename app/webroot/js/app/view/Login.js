Ext.define('SIS.view.Login', {
	extend : 'Ext.window.Window',
	alias : 'widget.login',

	autoShow : true,
	//height : 370,
	//width : 960,


	html: '<img src="/img/page.jpg" />',
//	bodyStyle: {
//	    background: '#000',
//	    padding: '0px'
//	},
//	title:'登录',
	layout: 'absolute',
	maximized:true,
	closeAction:'hide',
	closable:false,
	   bodyStyle : "padding:5px;",  
	items : [{
		iconCls:'key',
		xtype:'panel',
		layout:'fit',
		title:"登陆",
		height : 170,
		width : 360,
		 x: 550,
	        y: 250,
		items:[{
		xtype : 'form',
		frame : false,
		bodyPadding : 15,
		defaults : {
			xtype:'textfield',
			anchor:'100%',
			labelWidth:60,
			allowBlank:false,
			vtype:'alphanum',
			minLength:3,
			maxLength:25,
			msgTarget:'side'			
		},
		items:[
	       {
	    	   name:'user',
	    	   fieldLabel:"用户名",
	
	
	       },{
	    	   name:'password',
	    	   inputType:'password',
	    	   fieldLabel:"密码",
	    	   enableKeyEvents:true,
	    	   id:'password'
	    	   //规则：数字、大写、小写、特殊字符至少各一个，总计6-15个
	    	   //vtype:'customPass'
	
	
	       }],

			dockedItems:[
	             {
	            	 xtype:'toolbar',
	            	 dock:'bottom',
	            	 items:[
	        	        {
	        	        	xtype: 'tbfill' 
	        	        },
	        	        {
	        	        	xtype: 'button', // #25
	        	        	itemId: 'cancel',
	        	        	iconCls: 'cancel',
	        	        	text: 'Cancel'
	    	        	},
	    	        	{
	        	        	xtype: 'button', // #26
	        	        	itemId: 'submit',
	        	        	formBind: true, // #27
	        	        	iconCls: 'key-go',
	        	        	text: "Submit"
	    	        	}
	            	        ]
	             }
	             

	        ]

		} ]
			}
			]
/**/

});