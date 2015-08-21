Ext.define('SIS.controller.Students', {
    extend: 'Ext.app.Controller',
    
    models: ['Student'],
    stores:['Students','students.NativePlaces','departments.DepartmentsRead','Departments'],
 views:[
           'student.List',
           'student.Edit',
           'student.Add',
           'student.Import',
           'student.Search',
           'student.Profile',
           'student.NativePlaceChart',
           'student.Stat',
           'toolbar.AddEditDelete',
           'toolbar.AddEditDeleteSearch'
           
           
    ],
    refs:[{
    	ref : 'studentList',
    	selector:'studentlist'
    }],

    init: function() {

		this.control({
			'studentlist': {
            beforerender: this.onPanelRendered
        },
			'tabcontainer >studentlist':{
			itemdblclick:this.studentProfile
		},
			'studentedit button[action=save]':{
			click:this.updateStudent
		},
			'studentlist button#add':{
			click:this.addStudentForm
		
		},
			'studentlist button#edit':{
			click:this.editStudentForm
	
		},
			'studentlist button#delete':{
			click:this.deleteStudents
		
		},
		'addstudent button[action=add]':{
			click:this.addStudent
		},
		'editstudent button[action=save]':{
			click:this.updateStudent
		},
		'studentlist button[id=search]':{
			click:this.searchStudent
		},
		'studentlist combo#department':{
			select:this.selectDepartment
		},
		'studentlist button#search':{
			click:this.searchStudent
		},
		'studentchart button#download':{
			click:this.onChartDownload
		},
		'studentchart combo#department':{
			select:this.selectDepartment
		},
		});
    },
    editStudentForm:function(grid, record){
    	//console.log('Double clicked on '+record.get('name'));
    	

    	console.log("编辑");
    	var grid=this.getStudentList();
    	//var grid=Ext.get('studentlist');
    	var sm=grid.getSelectionModel();
    	var store=this.getStudentsStore();
    	if(sm.getSelection().length==0){
    		alert('请选择一条记录');
    		}
    	else{
    		var view = Ext.widget('editstudent');

    		var record=sm.getSelection()[0];
    		//console.log(record);
    		view.down('form').loadRecord(record);
    	}

    	
    
      
        
        
    },
    studentProfile:function(gird,record){
    	var view=Ext.widget('studentprofile');
    	view.down('form').loadRecord(record);
    	console.log(record);
    },

    updateStudent:function(button){
    	console.log('clicked the save button');
        var win    = button.up('window'),
        form   = win.down('form'),
        record = form.getRecord(),
        values = form.getValues();
        
	    record.set(values);
	  
	    ///console.log(tempStore);
	   // record.commit();
	    win.close();
	   
	    // synchronize the store after editing the record
	   this.getStudentsStore().sync({  
	        success: function(form, action) {
		   		//console.log(form);
           		//alert(Ext.JSON.decode(action));
		   		
	   			alert("更新成功");	},  
	   		failure: function(form, action) {  
	   			alert("更新失败");  
	   			}  
	   			
  });
	   //console.log(values);
	    //this.stores.sync()
    },
    addStudentForm:function(){
    	//alert("添加一个");
    	var addStudentview=Ext.widget('addstudent');
    },
    deleteStudents:function(){
    	console.log("删除");
    	var grid=this.getStudentList();
    	//var grid=Ext.get('studentlist');
    	var sm=grid.getSelectionModel();
    	var store=this.getStudentsStore();
    	if(sm.getSelection().length==0){
    		alert('请选择一条记录')}
    	else{
    		console.log(sm.getSelection()[0].data.id);
    		
    		Ext.MessageBox.confirm('删除记录','确定要删除'+sm.getSelection()[0].data.stu_name+'？',function(btn){
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
    addStudent:function(button){
    	//console.log('clicked the save button');
        var win    = button.up('window'),
        form   = win.down('form'),
        values = form.getValues();
       // var grid = Ext.ComponentQuery.query('studentlist > grid')[0]; 
        var store = this.getStudentsStore();
        var record = Ext.create('SIS.model.Student', values);  
       // console.log(record);
        store.add(record);  
        
    	this.getStudentsStore().sync({  
	        success: function(form, action) {
		   		//console.log(form);
           		//alert(Ext.JSON.decode(action));
		   		alert("保存成功");
		   		store.reload();
	   				},  
	   		failure: function(form, action) {  
	   			alert("保存失败"); } 
	   			}  );
        win.close();
    	//console.log(values)
    	//var addStudentview=Ext.widget('studentadd');
    },
    searchStudent:function(button){
    	console.log(Ext.get('KeyWord').getValue());
    	console.log( button.up('studentlist').down('KeyWord'));
    	key= button.up('studentlist').down('KeyWord').getValue();
    	console.log(key);
    }
    ,
    onPanelRendered: function() {
        console.log('The student panel was rendered');
        //console.log(this.stores);
        var store = this.getStudentsStore();
        store.reload();
        this.getStore('Students').autoLoad=true;
        this.getStore('Students').reload();        //此时装载 数据 
    }
    ,
    selectDepartment:function(comboBox){
    	department_id=comboBox.getValue();
    	console.log(department_id);
    	var dept_number;
		
	
    	
    	var store=this.getStudentsStore();
    	var statStore=this.getStudentsNativePlacesStore();
		Ext.Ajax.request({
			url:'departments/view/'+department_id+'/',
			/*params:{
			username:user,
			password:pass

			
		},*/
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
									dept_number=result.data.dept_number;
									console.log(dept_number);
									store.on('beforeload', function (store, options) {

							            var new_params = { dept_number:dept_number };
							            Ext.apply(store.proxy.extraParams, new_params);
							        	


							        });
									var newUrl='students/statNativePlace/'+department_id+'/';
							    	statStore.getProxy().url=newUrl;
							    	statStore.load();
									store.load({params:{start:0,page:1}});
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
		
    	
    	
    	
    	
    }
    ,
    searchStudent:function(button,grid){
    	var grid=button.up('panel');
    	var stu_name=grid.down('#name').getValue();
    	console.log(stu_name);
    	var store=this.getStudentsStore();
	
		store.on('beforeload', function (store, options) {
	
	        var new_params = { stu_name:stu_name };
	        Ext.apply(store.proxy.extraParams, new_params);
	    	
	
	
	    });
		store.load({params:{start:0,page:1}});
    	
    }
    ,
    onChartDownload:function(itme,e,option){
    	console.log('下载！');
    	var panel=itme.up('panel');
    	var chart=panel.down('chart')
    	console.log(chart);
    	 Ext.MessageBox.confirm('Confirm Download', 'Would you like to download the chart as an image?', function(choice){
             if(choice == 'yes'){
                 chart.save({
                     type: 'image/png'
                 });
             }
         });
    }
  });