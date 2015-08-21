Ext.define('SIS.controller.TeachingTasks', {
    extend: 'Ext.app.Controller',
    
    models: ['TeachingTask'],
    stores:['TeachingTasks','Courses','Users','Semesters','coursePlans.CoursePlanLists'],
    views:[
           'teachingTask.List',
           'toolbar.AddEditDelete',	
           'teachingTask.Edit',
           'teachingTask.Add'
// 'coursePlan.Import',
// 'coursePlan.Profile',
// 'coursePlan.Chart',
           
    ],
    refs:[{
    	ref : 'teachingTaskList',
    	selector:'teachingtasklist'
    }],
    init:function(){
    	this.control({
			'teachingtasklist': {
			beforerender: this.onPanelRendered
						},
			'teachingtasklist button#add':{
				click:this.addTeachingTaskListForm
						},

			'addteachingtask button[action=add]':{
				click:this.onAddTeachingTask
			},
			'teachingtasklist button#edit':{
				click:this.editTeachingTaskListForm
			},
			'editteachingtask button[action=save]':{
				click:this.onSaveTeachingTask
			}

			
			
    			});
    	},
    	onPanelRendered:function(){
    		console.log('TeachingTask');
    		var store=this.getTeachingTasksStore();
    		store.reload();
    	},
    	addTeachingTaskListForm:function(){
    		//console.log('addTeachingTaskListForm');
    		var addTeacnhingTaskview=Ext.widget('addteachingtask');
    	},
    	onAddTeachingTask:function(button){
            var win    = button.up('window'),
            form   = win.down('form'),
            record = form.getRecord(),
            values = form.getValues();
            var store = this.getTeachingTasksStore();
            var record = Ext.create('SIS.model.TeachingTask', values);  
           // console.log(record);
            store.add(record);  
        	this.getTeachingTasksStore().sync({  
    	        success: function(form, action) {
    		   		//console.log(form);
               		//alert(Ext.JSON.decode(action));
    	        	store.reload();
    		   		alert("添加课务分工成功");
    	   				},  
    	   		failure: function(form, action) {  
    	   			alert("添加失败"); } 
    	   			}  );
            win.close();
//        	console.log(values)
        	//var addUserview=Ext.widget('useradd');
        
    	
    	},
    	editTeachingTaskListForm:function(){

    		console.log('编辑课务分工');
    		var grid=this.getTeachingTaskList();
    		var sm=grid.getSelectionModel();
    		var store=this.getTeachingTasksStore();
    		if(sm.getSelection().length==0){
    			alert('请选择一条记录');
    			}
    		else{
    			var view = Ext.widget('editteachingtask');

    			var record=sm.getSelection()[0];
    		//console.log(record);
    			view.down('form').loadRecord(record);
    		}
    	},
    	onSaveTeachingTask:function(button){
    		console.log('保存成功');
    		var win=button.up('window'),
            form   = win.down('form'),
            record = form.getRecord(),
            values = form.getValues();
	    	record.set(values);
    		win.close();
    		   this.getTeachingTasksStore().sync({  
        	        success: function(form, action) {
        		   		alert("成功");
        	   				},  
        	   		failure: function(form, action) {  
        	   			alert("更新失败");  
        	   			}  
       	});
    	}
    	
});