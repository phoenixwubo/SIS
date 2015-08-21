Ext.define('SIS.controller.Login', {
	extend : 'Ext.app.Controller',
	views : ['Login','authentication.CapsLockTooltip','Header'],
	refs: [
		{
		ref: 'capslockTooltip',
		selector: 'capslocktooltip'
		}
		],
	init : function(application) {
		
		this.control( {
			'login':{
				beforerender:this.beforerender
			},

			'login form button#submit' : {
				click : this.onButtonClickSubmit
			},
			'login form button#cancel' : {
				click : this.onButtonClickCancel
			},
			'login form textfield': {
				specialkey: this. onTextfieldSpecialKey
			},
			
			'login form textfield[name=password]': {
				keypress: this.onTextfieldKeyPress
				},
			'appheader button#logout':{
				click:this.onButtonClickLogout
				}

		});

	},
	beforerender:function(){
		//渲染之前 先判断是否登录
		var success=false;
		

		/*Ext.Ajax.request({
			url:'users/loggedin/'		
		,
		faliure:function(conn,response,option,eOpts){
			Ext.Msg.show({
				title:'Error!',
				msg: conn.responseText,
				icon: Ext.Msg.ERROR,
				buttons: Ext.Msg.OK
				});
			success=false;
		},
		success:function(conn,response,optinons,eOpts){
			//var results=Ext.Json.decode
			//login.close(); 
			//return false;
			//Ext.create('SIS.view.SISViewport');
			success=true;
			console.log('已经登录');
			console.log(success);
			
		}});
		console.log(success);
		if(success){
			Ext.create('SIS.view.SISViewport');
			return false;
		}*/
	},
	onButtonClickSubmit : function(button, e, options) {
		//console.log('login submit')
		var formPanel=button.up('form'),
			login=button.up('login'),
			user=formPanel.down('textfield[name=user]').getValue(),
			pass=formPanel.down('textfield[name=password]').getValue();
		//console.log(user+pass);//调试用户名和密码 

		
		//http://evanwukong.blog.163.com/blog/static/1348364952010112154114216/
		//http://stackoverflow.com/questions/11512651/cakephp-authcomponent-login-using-ajax-without-form
		if (formPanel.getForm().isValid()){
			Ext.Ajax.request({
				url:'users/login/',
				params:{
				username:user,
				password:pass

				
			},
			failure : function(conn, response, options,
										eOpts) {
									Ext.Msg.show( {
										title : 'Error!',
										msg : conn.responseText,
										icon : Ext.Msg.ERROR,
										buttons : Ext.Msg.OK
									});
								},
			success : function(conn, response, options,
										eOpts) {
									var result = Ext.JSON.decode(
											conn.responseText, true); // #1
									if (!result) { // #2
										result = {};
										result.success = false;
										result.msg = conn.responseText;
									}
									if (result.success) { // #3
										login.close(); // #4
										console.log('登陆成功');
										console.log(result.success);
										//Ext.create('SIS.view.department.Tree'); // #5
										Ext.create('SIS.view.SISViewport');
									} else {
										Ext.Msg.show( {
											title : 'Fail!',
											msg : result.msg, // #6
											icon : Ext.Msg.ERROR,
											buttons : Ext.Msg.OK
										});
									}
								}
			})
		}
	},
	onButtonClickCancel : function(button, e, options) {
		//console.log('login cancel')
		button.up('form').getForm().reset();
	},
	onTextfieldSpecialKey: function(field, e, options) {
		//console.log(e.getKey());
		//按下回车 
		if (e.getKey() == e.ENTER){
		var submitBtn = field.up('form').down('button#submit');
		//
		submitBtn.fireEvent('click', submitBtn, e, options);
		}
		//按下esc
		if(e.getKey()==27){
			var cancelBtn = field.up('form').down('button#cancel');
			
			cancelBtn.fireEvent('click', cancelBtn, e, options);
			
		}
		},
	onTextfieldKeyPress:function(field,e,options){
			var charCode=e.getCharCode();
			
			if((e.shiftKey && charCode >= 97 && charCode <= 122) || // #2
			
			(!e.shiftKey && charCode >= 65 && charCode <= 90)){
	
				if(this.getCapslockTooltip() === undefined){ // #3
				Ext.widget('capslocktooltip'); // #4
				}
				this.getCapslockTooltip().show(); // #5
				} else {
				if(this.getCapslockTooltip() !== undefined){ // #6
				this.getCapslockTooltip().hide(); // #7
				}
				}
		},
	onButtonClickLogout:function(button,e,options){
			console.log('logout!');
			Ext.Ajax.request({
				url : 'users/logout/', // #1
							success : function(conn, response, options, eOpts) {
								var result = Ext.JSON.decode(conn.responseText,
										true);
								if (!result) {
									result = {};
									result.success = false;
									result.msg = conn.responseText;
								}
								if (result.success) { // #3
									button.up('mainviewport').destroy(); // #4
									window.location.reload(); // #5
								} else {
									Ext.Msg.show( { // #6
										title : 'Error!',
										msg : result.msg,
										icon : Ext.Msg.ERROR,
										buttons : Ext.Msg.OK
									});
								}
							},
							failure : function(conn, response, options, eOpts) {
								Ext.Msg.show( { // #7
									title : 'Error!',
									msg : conn.responseText,
									icon : Ext.Msg.ERROR,
									buttons : Ext.Msg.OK
								});
							}
						});
		}

});