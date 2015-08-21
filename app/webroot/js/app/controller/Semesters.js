Ext.define('SIS.controller.Semesters', {
    extend: 'Ext.app.Controller',
    
    models: ['Semester'],
    stores:['Semesters'],
    views:[
           'semester.List',
           'semester.Edit',
           'semester.Add'
    ],
    refs:[{
    	ref : 'semesterList',
    	selector:'semesterlist'
    }],
    
    init: function() {

		this.control({
			'semesterlist': {
            beforerender: this.onSemesterPanelRendered
        },
			'tabcontainer > semesterlist':{
			itemdblclick:this.editSemesterForm
		},
			'editsemester button[action=save]':{
			click:this.updateSemester
		},
			'semesterlist button#add':{
			click:this.addSemesterForm
		
		},
		'semesterlist button#edit':{
		click:this.editSemesterForm
	
	},
			'semesterlist button#delete':{
			click:this.onDeleteSemester
		
		},'addsemester button[action=add]':{
			click:this.addSemester
		}
		});
    },
    editSemesterForm:function(grid, record){
    	
    	

    	var grid=this.getSemesterList();
    	var sm=grid.getSelectionModel();
    	var store=this.getSemestersStore();
    	if(sm.getSelection().length==0){
    		alert('请选择一条记录');
    		}
    	else{
    		var view = Ext.widget('editsemester');

    		var record=sm.getSelection()[0];
    		//console.log(record);
    		view.down('form').loadRecord(record);
    	}

    },

    updateSemester:function(button){
        var win    = button.up('window'),
        form   = win.down('form'),
        record = form.getRecord(),
        values = form.getValues();
	    record.set(values);
	    win.close();
	   this.getSemestersStore().sync({  
	        success: function(form, action) {
		   		alert("成功");
	   				},  
	   		failure: function(form, action) {  
	   			alert("更新失败");  
	   			}  
  });
	   
	    //this.stores.sync()
    },
    addSemesterForm:function(){
    	//alert("再来一个");
    	var addSemesterview=Ext.widget('addsemester');
    },
    addSemester:function(button){
        var win    = button.up('window'),
        form   = win.down('form'),
        record = form.getRecord(),
        values = form.getValues();
        var store = this.getSemestersStore();
        var record = Ext.create('SIS.model.Semester', values);  
        console.log(record);
        store.add(record);  
    	this.getSemestersStore().sync({  
	        success: function(form, action) {
		   		//console.log(form);
           		//alert(Ext.JSON.decode(action));
	        	store.reload();
		   		alert("注册成功");
	   				},  
	   		failure: function(form, action,response) {  
	   			/*Ext.Msg.show({
			           title:'Error!',
			           msg: response.responseText,
			           icon: Ext.Msg.ERROR,
			           buttons: Ext.Msg.OK
			});*/
	   			alert('失败！');
	   			} 
	   			}  );
        win.close();
    	console.log(values)
    	//var addSemesterview=Ext.widget('semesteradd');
    },
    onDeleteSemester:function(){

    	console.log("删除");
    	var grid=this.getSemesterList();
    	//var grid=Ext.get('studentlist');
    	var sm=grid.getSelectionModel();
    	var store=this.getSemestersStore();
    	if(sm.getSelection().length==0){
    		alert('请选择一条记录')}
    	else{
    		console.log(sm.getSelection()[0].data.id);
    		
    		Ext.MessageBox.confirm('删除记录','确定要删除'+sm.getSelection()[0].data.sem_name+'？',function(btn){
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
    onSemesterPanelRendered:function() {
        console.log('The semester panel was rendered');
        //console.log(this.stores);
        this.getStore('Semesters').autoLoad=true;
        this.getStore('Semesters').reload();        //此时装载 数据 
    }
    
    
});