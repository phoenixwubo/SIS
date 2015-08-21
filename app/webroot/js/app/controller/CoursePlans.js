Ext.define('SIS.controller.CoursePlans', {
    extend: 'Ext.app.Controller',
    
    models: ['CoursePlan'],
    stores:['CoursePlans','Courses','Users','Semesters','coursePlans.CoursePlanLists'],
    views:[
           'coursePlan.List',
           'toolbar.AddEditDelete',	
           'coursePlan.Edit',
           'coursePlan.Add'
// 'coursePlan.Import',
// 'coursePlan.Profile',
// 'coursePlan.Chart',
           
    ],
    refs:[{
    	ref : 'coursePlanList',
    	selector:'courseplanlist'
    }],
    
    init:function(){
    	this.control({
			'coursePlanlist': {
			beforerender: this.onPanelRendered
						},
			'tabcontainer > courseplanlist':{
			itemdblclick:this.getSubStore
			},
			'courseplanlist button#add':{
			click:this.addCoursePlanForm
		
			},
			'courseplanlist button#edit':{
			click:this.editCoursePlanForm
	
			},
			'courseplanlist button#delete':{
			click:this.onDeleteCoursePlan
			},
			'addcourseplan button[action=add]':{
				click:this.onAddCoursePlan
			},
			'editcourseplan button[action=save]':{
				click:this.onEditCoursePlan
			}
			
			
			

			
			
    			});
    	},
    	onPanelRendered:function(){
    		console.log('Courser');
    		var store=this.getCoursePlansStore();
    		store.reload();
    	},
    	getSubStore:function(){
//    		console.log('testtest！');
    		var grid=this.getCoursePlanList();
    		var store=this.getCoursePlansStore();
    		var sm=grid.getSelectionModel();
//    		console.log(sm);
//    		console.log(sm.getSelection()[0].data.course_name);
//    		console.log(sm.getSelection()[0].data.id);
    	},
    	addCoursePlanForm:function(){
    		var addCoursetview=Ext.widget('addcourseplan');
    	},
    	onAddCoursePlan:function(button){
    		console.log('good!');

            var win    = button.up('window'),
            form   = win.down('form'),
            record = form.getRecord(),
            values = form.getValues();
            var store = this.getCoursePlansStore();
            var record = Ext.create('SIS.model.CoursePlan', values);  
            console.log(record);
            store.add(record);  
        	this.getCoursePlansStore().sync({  
    	        success: function(form, action) {
    		   		//console.log(form);
               		//alert(Ext.JSON.decode(action));
    	        	store.reload();
    		   		alert("添加课程计划成功");
    	   				},  
    	   		failure: function(form, action) {  
    	   			alert("添加失败"); } 
    	   			}  );
            win.close();
        	console.log(values);
        	CoursePlanListsStore=Ext.getStore('coursePlans.CoursePlanLists');
        	CoursePlanListsStore.reload();
        	//var addUserview=Ext.widget('useradd');
        
    	},
    	editCoursePlanForm:function(){
    		console.log('编辑课程计划!');
    		var grid=this.getCoursePlanList();
    		var sm=grid.getSelectionModel();
    		var store=this.getCoursePlansStore();
    		if(sm.getSelection().length==0){
    			alert('请选择一条记录');
    			}
    		else{
    			var view = Ext.widget('editcourseplan');

    			var record=sm.getSelection()[0];
    		//console.log(record);
    			view.down('form').loadRecord(record);
    	}},
    	onEditCoursePlan:function(button){
    		 var win    = button.up('window'),
             form   = win.down('form'),
             record = form.getRecord(),
             values = form.getValues();
 	    	record.set(values);
     	    win.close();
     	   this.getCoursePlansStore().sync({  
     	        success: function(form, action) {
     		   		alert("成功");
     	   				},  
     	   		failure: function(form, action) {  
     	   			alert("更新失败");  
     	   			}  
    	});
     	   
    	},
    	onDeleteCoursePlan:function(){

        	console.log("删除");
        	var grid=this.getCoursePlanList();
        	var sm=grid.getSelectionModel();
        	var store=this.getCoursePlansStore();
        	if(sm.getSelection().length==0){
        		alert('请选择一条记录')}
        	else{
        		console.log(sm.getSelection()[0].data.id);
        		
        		Ext.MessageBox.confirm('删除记录','确定要删除'+sm.getSelection()[0].data.course_name+'？',function(btn){
        			if(btn == 'yes'){
    					store.remove(sm.getSelection());
    					store.sync({
    						success : function(form, action) {
    							// console.log(form);
    							// alert(Ext.JSON.decode(action));

    							alert("删除成功");
    						},
    						failure : function(form, action) {
    							alert("删除失败");
    						}
    					});
        			}
        		});

        	}

        	
        
        }
});
