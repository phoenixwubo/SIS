
Ext.define('SIS.controller.Electives', {
    extend: 'Ext.app.Controller',
    
    models: ['elective.Elective'],
    stores:['electives.Electives','electives.ElectiveResults','Semesters','departments.DepartmentsList','Courses','ResultTypes'],
    views:[
           'elective.AddElectivePlan',
           'elective.ElectiveLesson',
			'elective.List',
           'elective.Selector',
           'elective.ResultList',
           'elective.NoexamResultList'


    ],
    refs:[{
    	ref : 'electiveList',
    	selector:'electivelist'
    },{
    	ref:'electiveResultList',
    	selector:'electiveresultlist'
    }],
    init:function(){
    	this.control({
    		'electivelesson #add ':{
    			click:this.addelectiveplanForm
    		},
    		'addelectiveplan button[action=add]':{
    			click:this.onAddElectivePlan
    		},
    		'electivelist button[id=saveElective]':{
				click:this.saveElective
			},
			'electiveresultlist button[id=saveElectiveResult]':{
				click:this.saveResult
			}
    		
    	});
    	},
    	addelectiveplanForm:function(){
    		var view = Ext.widget('addelectiveplan');
    	},
    	onAddElectivePlan:function(button){
    		var win=button.up('window'),
    		form=win.down('form');
    		 values = form.getValues();
    		 department_id=values.department_id
    		 semester_id=values.semester_id;
    		 number=values.number;
    		 Ext.Ajax.request({

 				url:'Electives/batchElective/'+department_id+'/'+semester_id+'/null/'+number,
// 				params:{
// 				username:user,
// 				password:pass
//
// 				
// 			},
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
 										win.close(); // #4
 										alert("添加选修课程计划成功");
 										console.log(result.success);
 									} else {
 										Ext.Msg.show( {
 											title : 'Fail!',
 											msg : result.msg, // #6
 											icon : Ext.Msg.ERROR,
 											buttons : Ext.Msg.OK
 										});
 									}
 								}
 			
    		 });
    	},
    	saveElective:function(){
    		console.log('保存！');
//    		console.log(this.getElectiveList().getStore());
    		this.getElectiveList().getStore().sync({  
    	        success: function(form, action) {
    		   		alert("成功");
    	   				},  
    	   		failure: function(form, action) {  
    	   			alert("更新失败");  
    	   			}  	
    	});
    	},
    	saveResult:function(){
    		console.log('保存！');
//    		console.log(this.getElectiveList().getStore());
    		this.getElectiveResultList().getStore().sync({  
    	        success: function(form, action) {
    		   		alert("成功");
    	   				},  
    	   		failure: function(form, action) {  
    	   			alert("更新失败");  
    	   			}  	
    	});
    	}
}); 