Ext.application( { // #1
	name : 'SIS',
	appFolder: '/js/app',
	controllers:['Students',
                 'Login',
                 'Users',
                 'CoursePlans',
                 'Courses',
                 'Manu',
                 'Semesters',
                 'Scores',
                 'Departments',
                 'TeachingTasks',
                 'Electives',
                 'ResultSheet'],
	requires:[
	        'SIS.view.Login',
	        'SIS.util.Utilities'
	          ],
	views:['Login',],
	splashscreen: {},
	 
	init: function() {
	    // 在整个页面上用一个类似遮罩效果覆盖 ，同时获取这个 遮罩的引用
		splashscreen = Ext.getBody().mask('系统载入中……','splashscreen');
		splashscreen.addCls('splashscreen');
		Ext.DomHelper.insertFirst(Ext.query('.x-mask-msg')[0], {
			cls : 'x-splash-icon'
		});
		//正则表达式验证
		Ext.apply(Ext.form.field.VTypes, {
			customPass: function(val, field) {
			return /^((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20})/.
			test(val);
			},
			customPassText: 'Not a valid password. Length must be at least 6 characters and maximum of 20Password must contain one digit, one letter lowercase, one letter uppercase, onse special symbol @#$% and 	between 6 and 20 characters.',
			});
		
	},
	 
	launch: function() {
	 
	    Ext.tip.QuickTipManager.init();
	    var task = new Ext.util.DelayedTask(function() {
	 
	        // 淡出遮罩
	        splashscreen.fadeOut({
	            duration: 500,
	            remove: true
	        });
	 
	        // 淡出遮罩的文字
	        splashscreen.next().fadeOut({
	            duration: 500,
	            remove: true,

				listeners: {
				afteranimate: function(el, startTime, eOpts ){
	        	
	        	
	        	Ext.Ajax.request({
	    			url:'users/loggedin/'		
	    		,
	    		faliure:function(conn,response,option,eOpts){
	    			Ext.Msg.show({
	    				title:'Error!',
	    				msg: conn.responseText,
	    				icon: Ext.Msg.ERROR,
	    				buttons: Ext.Msg.OK
	    				});
	    			console.log('请登录');
	    			Ext.widget('login'); // 
	    		},
	    		success:function(conn,response,optinons,eOpts){


					var result = Ext.JSON.decode(
							conn.responseText, true); // #1
					if (!result) { // #2
						result = {};
						result.success = false;
						result.msg = conn.responseText;
						console.log('没有返回值');
						//Ext.widget('login'); 
					}
					console.log(result.success);
					if (result.success) { // #3
						
						console.log('已经登录 ');
						//Ext.create('SIS.view.department.Tree'); // #5
						Ext.create('SIS.view.SISViewport');
					} else {
						Ext.widget('login'); 
						/*Ext.Msg.show( {
							title : 'Fail!',
							msg : result.msg, // #6
							icon : Ext.Msg.ERROR,
							buttons : Ext.Msg.OK
						});*/
					}
	    			

	    			
	    			
	    		}});
				
				}}
	        });
	 
	   });
	 
	   task.delay(1000);
	}

});