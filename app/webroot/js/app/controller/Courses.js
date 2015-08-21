Ext.define('SIS.controller.Courses', {
    extend: 'Ext.app.Controller',
    
    models: ['Course'],
    stores:['Courses','Users','Semesters'],
    views:[
           'course.List',
           'toolbar.AddEditDelete',
           'course.Edit',
           'course.Add'
//           'course.Profile',
//           'course.Chart'
           
    ],
    refs:[{
    	ref : 'courseList',
    	selector:'courselist'
    }],
    
    init:function(){
    	this.control({
			'courselist': {
				beforerender: this.onPanelRendered
						},
			'tabcontainer > courselist':{
				itemdblclick:this.getSubStore
			},
			'courselist button#add':{
				click:this.onAddCourseForm
			},
			'courselist button#edit':{
				click:this.onButtonClickEditCourse
			},
			'addcourse button[action=add]':{
				click:this.onAddCourse
			},
			'editcourse button[action=save]':{
				click:this.onEditCourse
			},
			'courselist button#delete':{
				click:this.onButtonClickDeletetCourse
			}
    			});
    	},
    	onPanelRendered:function(){
    		console.log('Courser');
    		var store=this.getCoursesStore();
    		store.reload();
    	},
    	getSubStore:function(){
    		console.log('testtest！');
    		var grid=this.getCourseList();
    		var store=this.getCoursesStore();
    		var sm=grid.getSelectionModel();
    		console.log(course);
    		//um=course.getUser();
    		console.log(sm);
    		console.log(sm.getSelection()[0].data.course_name);
    		console.log(sm.getSelection()[0].data.id);
    	},
    	onAddCourseForm:function(button){
    		var addStudentview=Ext.widget('addcourse');
    	},
    	

    	onAddCourse:function(button){

//    		console.log('good!');

    		var win    = button.up('window'),
            form   = win.down('form'),
            record = form.getRecord(),
            values = form.getValues();
            var store = this.getCoursesStore();
            var record = Ext.create('SIS.model.Course', values);  
//            console.log(record);
            store.add(record);  
        	this.getCoursesStore().sync({  
    	        success: function(form, action) {
    		   		//console.log(form);
               		//alert(Ext.JSON.decode(action));
    	        	store.reload();
    		   		alert("添加课程成功");
    	   				},  
    	   		failure: function(form, action) {  
    	   			alert("添加失败"); } 
    	   			}  );
            win.close();
//        	console.log(values)
        	//var addUserview=Ext.widget('useradd');
        
    	
    	},
    	onButtonClickEditCourse:function(){
    		console.log('编辑!');
    		var grid=this.getCourseList();
        	var sm=grid.getSelectionModel();
        	var store=this.getCoursesStore();
        	if(sm.getSelection().length==0){
        		alert('请选择一条记录');
        		}
        	else{
        		var view = Ext.widget('editcourse');

        		var record=sm.getSelection()[0];
        		//console.log(record);
        		view.down('form').loadRecord(record);
        	}
    		
    	},
    	onEditCourse:function(button){
            var win    = button.up('window'),
            form   = win.down('form'),
            record = form.getRecord(),
            values = form.getValues();
    	    record.set(values);
    	    win.close();
    	   this.getCoursesStore().sync({  
    	        success: function(form, action) {
    		   		alert("成功");
    	   				},  
    	   		failure: function(form, action) {  
    	   			alert("更新失败");  
    	   			}  
      });
    	},
    	onButtonClickDeletetCourse:function(){

        	console.log("删除");
        	var grid=this.getCourseList();
        	var sm=grid.getSelectionModel();
        	var store=this.getCoursesStore();
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

        	
        
        },
});
