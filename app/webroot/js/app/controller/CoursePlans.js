Ext.define('SIS.controller.CoursePlans', {
    extend: 'Ext.app.Controller',
    
    models: ['CoursePlan'],
    stores:['CoursePlans',
            'Courses',
            'Users',
            'users.UsersList',
            'Semesters',
            'coursePlans.CoursePlanLists',
            'coursePlans.ScoreTypes',
            'coursePlans.CourseTypes'],
    views:[
           'coursePlan.List',
           'toolbar.AddEditDelete',	
           'coursePlan.Edit',
           'coursePlan.Add',
           'toolbar.FilteSubject'
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
			},
			'courseplanlist button#filter':{
				click:this.filterSubjects
			
			},
			'courseplanlist combo#course_type':{
			select:this.onFilteCourseType
		
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

        	
        
        },
        filterSubjects:function(button){
        	
        	grid=button.up('grid');
        	console.log(grid);
        	department_id=grid.down('#department').getValue();
        	semester_id=grid.down('#semester').getValue();
        	course_id=grid.down('#course').getValue();
        	score_type=grid.down('#score_type').getValue();
        	course_type=grid.down('#course_type').getValue();
        	
        	store=grid.getStore();
        	store.on('beforeload', function (store, options) {

	            var new_params = { department_id:department_id,semester_id:semester_id, course_id:course_id,score_type:score_type,course_type:course_type};
	            Ext.apply(store.proxy.extraParams, new_params);
	        	


	        });
        		store.load({params:{start:0,page:1}});
        },
        
        onFilteCourseType:function(combo){
        	value=combo.getValue();
        	courseCombo=combo.up('grid').down('#course')
        	store=this.getCoursesStore();
        	console.log(store);
        	var records = [];
        	store.each(function(r){
        		records.push(r.copy());
        	});
        	var store2 = new Ext.data.Store({
        		recordType: store.recordType,
        		model:store.getProxy().getModel()
        		
        	});
//        	store2.model=store.getProxy().getModel();
        	store2.add(records);
//        	store.clearFilter();
        	store2.filter('course_type',value);
        	courseCombo.bindStore(store2);
        	console.log(store2);
        }
});
